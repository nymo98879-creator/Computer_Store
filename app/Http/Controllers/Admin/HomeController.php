<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        // Load categories with their products
        $categories = Category::with('products')->get();

        // Load all products for the "Our Products" section
        $products = Product::with('category')->take(6)->get();

        return view('FrontEnd.Home', compact('categories', 'products'));
    }
}
