<?php

namespace App\Http\Controllers\Backend;

use App\Models\Backend\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Backend\ProductRequest;
use App\Http\Services\Backend\ProductService;
use App\Http\Services\Backend\CategoryService;
use App\Http\Middleware\AdminMiddleware;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService, private CategoryService $categoryService
    )
    {
        $this->middleware(AdminMiddleware::class);
    }

    public function index()
    {
        return view('backend.products.index', [
            'products' => $this->productService->select(10),
        ]);
    }

    public function create()
    {
        if (auth()->user()->role === 'owner') {
            return redirect()->route('panel.products.index')->with('error', 'Anda tidak memiliki izin untuk menambah data product.');
        }

        return view('backend.products.create', [
            'categories' => $this->categoryService->select(),
        ]);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        try {
            Product::create($data);

            return redirect()->route('panel.product.index')->with('success', 'Product successfully saved');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show(string $uuid)
    {
        //
    }

    public function edit(string $uuid)
    {
        if (auth()->user()->role === 'owner') {
            return redirect()->route('panel.products.index')->with('error', 'Anda tidak memiliki izin untuk mengedit data product.');
        }

        return view('backend.products.edit', [
            'product' => $this->productService->selectFirstBy('uuid', $uuid),
            'categories' => $this->categoryService->select(),
        ]);
    }

    public function update(ProductRequest $request, string $uuid)
    {
        if (auth()->user()->role === 'owner') {
            return redirect()->route('panel.products.index')->with('error', 'Anda tidak memiliki izin untuk menperbarui data product.');
        }

        $data = $request->validated();

        try {
            $product = $this->productService->selectFirstBy('uuid', $uuid);

            if ($request->hasFile('image')) {
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                $data['image'] = $request->file('image')->store('products', 'public');
            }

            $product->update($data);

            return redirect()->route('panel.product.index')->with('success', 'Product successfully updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $uuid)
    {
        if (auth()->user()->role === 'owner') {
            return response()->json([
                'message' => 'Anda tidak memiliki izin untuk menghapus data product.'
            ], 403);
        }

        $product = $this->productService->selectFirstBy('uuid', $uuid);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product successfully deleted',
        ]);
    }
}
