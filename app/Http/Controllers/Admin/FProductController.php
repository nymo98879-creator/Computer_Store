<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FProductController extends Controller
{
    //
    public function indexfront()
    {
        $categories = Category::all();
        $products = Product::with('category')->get(); // Use get() to fetch all products
        return view('FrontEnd.fproduct', compact('products', 'categories'));
    }
    // ===============================
    // 🧾 List All Products (non-paginated)
    // ===============================
    public function search(Request $request)
    {
        // Get search term from input
        $search = $request->input('search');

        // Search in product name
        $products = Product::where('name', 'like', "%{$search}%")->get();

        // Show result in FrontEnd home view
        return view('FrontEnd.fproduct', compact('products', 'search'));
    }
}
