<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class DCategoyDesktopController extends Controller
{
    //
    public function index()
    {
        $categories = Category::with('products')->find(2);
        return view('admin.category.desktop', compact('categories'));
    }
}
