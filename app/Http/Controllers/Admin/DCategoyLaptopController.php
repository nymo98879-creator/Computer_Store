<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class DCategoyLaptopController extends Controller
{
    //
    public function index()
    {
        // $categories = Category::with('products')->get();
        $categories = Category::with('products')->find(1);
        // dd($categories);
        // $categories = collect([$category]);
        return view('admin.category.laptop', compact('categories'));
    }
}
