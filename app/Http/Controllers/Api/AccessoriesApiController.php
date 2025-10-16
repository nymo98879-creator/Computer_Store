<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AccessoriesApiController extends Controller
{
    //
    public function show($id)
    {
        $category = Category::with('products')->find($id); // eager load products

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($category);
    }
}
