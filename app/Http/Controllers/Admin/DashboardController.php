<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function counts()
    {
        $categories = Category::count();
        $products = Product::count();
        // dd($categories);
        // dd($categories, $products);

        return view('admin.dashboard', compact('categories','products'));
    }
}
