<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CategoryRequest;
use App\Http\Services\Backend\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryService $categoryService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.categories.index', [
            'categories' => $this->categoryService->selectPaginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('panel.category.index')->with('error', 'Anda tidak memiliki izin untuk menambah kategori.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        try {
            $this->categoryService->create($data);

            return redirect()->route('panel.category.index')->with('success', 'Category successfully saved');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
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
    public function edit(string $uuid)
    {

        if (auth()->user()->role === 'owner') {
            return redirect()->route('panel.category.index')->with('error', 'Anda tidak memiliki izin untuk mengedit kategori.');
        }

        return view('backend.categories.edit', [
            'category' => $this->categoryService->selectFirstBy('uuid', $uuid)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $uuid)
    {
        if (auth()->user()->role === 'owner') {
            return redirect()->route('panel.category.index')->with('error', 'Anda tidak memiliki izin untuk memperbarui kategori.');
        }

        $data = $request->validated();

        $category = $this->categoryService->selectFirstBy('uuid', $uuid);

        try {
            $this->categoryService->update($data, $category->uuid);

            return redirect()->route('panel.category.index')->with('success', 'Category successfully updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid): JsonResponse
    {
        if (auth()->user()->role === 'owner') {
            return response()->json([
                'message' => 'Anda tidak memiliki izin untuk menghapus kategori.'
            ], 403);
        }
        
        $category = $this->categoryService->selectFirstBy('uuid', $uuid);

        $category->delete();

        return response()->json([
            'message' => 'Category successfully deleted'
        ]);
    }
}
