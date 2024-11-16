<?php
namespace App\Http\Services;

use App\Models\Product;

class ProductService
{
    public function select($paginate = null)
    {
        if ($paginate) {
            return Product::latest()->select('id', 'uuid', 'name', 'description', 'price', 'stock', 'image')->paginate($paginate);
        }
        return Product::latest()->select('id', 'uuid', 'name', 'description', 'price', 'stock', 'image')->get();
    }
    public function selectFirstBy($column, $value)
    {
        return Product::where($column, $value)->firstOrFail();
    }
}
