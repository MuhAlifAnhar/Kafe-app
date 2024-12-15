<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\RawMaterialRequest;
use App\Http\Services\Backend\CategoryService;
use App\Http\Services\Backend\RawMaterialService;
use App\Models\Backend\RawMaterial;
use Illuminate\Contracts\View\View;

class RawMaterialController extends Controller
{
    public function __construct(
        private RawMaterialService $rawMaterialService,
        private CategoryService $categoryService
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.raw-material.index', [
            'rawMaterials' => $this->rawMaterialService->select(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role === 'owner') {
            return redirect()->route('panel.raw-material.index')->with('error', 'Anda tidak memiliki izin untuk menambah data raw material.');
        }

        return view('backend.raw-material.create', [
            'categories' => $this->categoryService->select(),
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

            return redirect()->route('panel.raw-material.index')->with('success', 'Data raw material berhasil disimpan');
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
    public function edit(string $uuid): View
    {
        if (auth()->user()->role === 'owner') {
            return redirect()->route('panel.raw-material.index')->with('error', 'Anda tidak memiliki izin untuk mengedit data raw material.');
        }

        return view('backend.raw-material.edit', [
            'rawMaterial' => $this->rawMaterialService->selectFirstBy('uuid', $uuid),
            'categories' => $this->categoryService->select(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RawMaterialRequest $request, string $uuid)
    {
        if (auth()->user()->role === 'owner') {
            return redirect()->route('panel.raw-material.index')->with('error', 'Anda tidak memiliki izin untuk menperbarui data raw material.');
        }

        $data = $request->validated();

        try {
            $getRawMaterial = $this->rawMaterialService->selectFirstBy('uuid', $uuid);

            $getRawMaterial->update($data);

            return redirect()->route('panel.raw-material.index')->with('success', 'Data raw material berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        if (auth()->user()->role === 'owner') {
            return response()->json([
                'message' => 'Anda tidak memiliki izin untuk menghapus data raw material.'
            ], 403);
        }

        $getRawMaterial = $this->rawMaterialService->selectFirstBy('uuid', $uuid);

        $getRawMaterial->delete();

        return response()->json([
            'message' => 'Data raw material berhasil dihapus',
        ]);
    }
}
