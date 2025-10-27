<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class LaptopController extends Controller
{
    //
    public function index()
    {
        $category = Category::where('name', 'laptop')->with('products')->firstOrFail();
        return view('FrontEnd.fcategory.laptop', compact('category'));
    }
}
