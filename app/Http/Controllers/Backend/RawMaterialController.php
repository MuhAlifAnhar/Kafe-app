<?php

namespace App\Http\Controllers\Backend;

use App\Models\RawMaterial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\CategoryService;
use App\Http\Requests\RawMaterialRequest;
use App\Http\Services\RawMaterialService;

class RawMaterialController extends Controller
{
    public function __construct(
        private RawMaterialService $rawMaterialService,
        private CategoryService $categoryService
        )
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.raw-material.index', [
            'rawMaterials' => $this->rawMaterialService->select(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.raw-material.create', [
            // 'categories' => $this->categoryService->select()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RawMaterialRequest $request)
    {
        $data = $request->validated();

        try {
            RawMaterial::create($data);

            return redirect()->route('panel.raw-material.index')->with('success', 'Data bahan baku berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        return view('backend.raw-material.edit', [
            'rawMaterial' => $this->rawMaterialService->selectFirstBy('uuid', $uuid)
            // 'categories' => $this->categoryService->select()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RawMaterialRequest $request, string $uuid)
    {
        $data = $request->validated();

        try {
            $getRawMaterial = $this->rawMaterialService->selectFirstBy('uuid', $uuid);

            $getRawMaterial->update($data);

            return redirect()->route('panel.raw-material.index')->with('success', 'Data bahan baku berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        $getRawMaterial = $this->rawMaterialService->selectFirstBy('uuid', $uuid);

        $getRawMaterial->delete();

        return response()->json([
            'message' => 'Data bahan baku berhasil dihapus'
        ]);
    }
}
