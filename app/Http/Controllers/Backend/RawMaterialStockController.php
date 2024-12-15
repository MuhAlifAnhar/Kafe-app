<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Backend\RawMaterial;
use App\Http\Controllers\Controller;
use App\Models\Backend\RawMaterialStock;
use App\Http\Requests\Backend\RawMaterialStockRequest;
use App\Http\Services\Backend\RawMaterialStockService;
use App\Http\Requests\Backend\RawMaterialStock\StoreRequest;
use App\Http\Requests\Backend\RawMaterialStock\FilterRequest;

class RawMaterialStockController extends Controller
{
    public function __construct(
        private RawMaterialStockService $stockService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get low stock alerts dari RawMaterial
        $rawMaterials = RawMaterial::where('stock', '<=', 10)
            ->with('category')
            ->get();

        // Get stock movement history dari RawMaterialStock
        $stockHistory = RawMaterialStock::with(['rawMaterial', 'user'])
            ->latest()
            ->paginate(10);

        return view('backend.raw-material-stock.index', [
            'stockHistory' => $stockHistory,
            'rawMaterials' => $rawMaterials
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role === 'owner') {
            return redirect()->route('panel.event.index')->with('error', 'Anda tidak memiliki izin untuk memperbarui data raw material stok.');
        }

        return view('backend.raw-material-stock.create', [
            'rawMaterials' => RawMaterial::with('category')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $this->stockService->addStock(
                $request->validated('raw_material_id'),
                $request->validated('quantity'),
                $request->validated('type'),
                $request->validated('notes')
            );

            return redirect()
                ->route('panel.raw-material-stock.index')
                ->with('success', 'Stock updated successfully');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function history(FilterRequest $request)
    {
        return view('backend.raw-material-stock.history', [
            'stocks' => RawMaterialStock::with(['rawMaterial', 'user'])
                ->when($request->raw_material_id, function ($query) use ($request) {
                    return $query->where('raw_material_id', $request->raw_material_id);
                })
                ->when($request->type, function ($query) use ($request) {
                    return $query->where('type', $request->type);
                })
                ->when($request->date_from, function ($query) use ($request) {
                    return $query->whereDate('date', '>=', $request->date_from);
                })
                ->when($request->date_to, function ($query) use ($request) {
                    return $query->whereDate('date', '<=', $request->date_to);
                })
                ->latest()
                ->paginate(10),
            'rawMaterials' => RawMaterial::all(), // Untuk dropdown filter
            'filters' => $request->only(['raw_material_id', 'type', 'date_from', 'date_to'])
        ]);
    }
}
