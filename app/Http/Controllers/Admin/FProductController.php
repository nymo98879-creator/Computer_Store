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
}
