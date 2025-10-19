<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class FCategoryController extends Controller
{
    //
    public function indexfront()
    {
        // Fetch laptop category and its products
        $laptopCategory = Category::where('name', 'Laptop')->with('products')->first();

        // Fetch desktop category and its products
        $desktopCategory = Category::where('name', 'Desktop')->with('products')->first();

        return view('FrontEnd.fcategory', compact('laptopCategory', 'desktopCategory'));
    }
}
