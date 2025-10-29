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
        $query = Product::query();

        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by price
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by category (relationship)
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('name', $request->category);
            });
        }

        $products = $query->get();


        return view('FrontEnd.fproduct', compact('products'));
    }


    // public function search(Request $request)
    // {
    //     // Get search term from input
    //     $search = $request->input('search');

    //     // Search in product name
    //     $products = Product::where('name', 'like', "%{$search}%")->get();

    //     // Show result in FrontEnd home view
    //     return view('FrontEnd.fproduct', compact('products', 'search'));
    // }
}
