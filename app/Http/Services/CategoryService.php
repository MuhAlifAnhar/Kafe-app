<?php

namespace App\Http\Services;

use App\Models\Category;

class CategoryService
{
    public function select($column = null, $value = null)
    {
        if ($column) {
            return Category::where($column, $value)->select('id', 'uuid', 'name', 'slug')->firstOrFail();
        }

        return Category::latest()->get(['id', 'uuid', 'name', 'slug']);
    }
}
