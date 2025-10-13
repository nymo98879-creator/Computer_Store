<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    //
    public function index()
    {
        // Fetch products with category relationship
        $products = Product::with('category')->get();

        // Return JSON response
        return response()->json($products);
    }
}
