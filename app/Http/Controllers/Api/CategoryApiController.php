<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use finfo;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{

    public function apiIndex()
    {

        // try {
        //     // Get all categories with one product image (for display)
        //     $categories = Category::with(['products' => function ($query) {
        //         $query->select('id', 'image', 'category_id')->limit(3);
        //     }])->get(['id', 'name']);

        //     // Transform data to include product image
        //     $categories = $categories->map(function ($cat) {
        //         return [
        //             'id' => $cat->id,
        //             'name' => $cat->name,
        //             'image' => $cat->products->first()->image ?? 'default.png', // fallback if no product
        //         ];
        //     });

        //     return response()->json($categories, 200);
        // } catch (\Exception $e) {
        //     return response()->json(['error' => $e->getMessage()], 500);
        // }
        try {
            $categories = Category::with('products')->get()->map(function ($cat) {
                return [
                    'id' => $cat->id,
                    'name' => $cat->name,
                    'images' => $cat->products->pluck('image')->take(2), // first 3 images
                ];
            });

            return response()->json($categories, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
