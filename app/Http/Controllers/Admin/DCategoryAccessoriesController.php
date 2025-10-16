<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class DCategoryAccessoriesController extends Controller
{
    //
    public function index()
    {
        $categories = Category::with('products')->find(3);
        return view('admin.category.accessories', compact('categories'));
    }
}
