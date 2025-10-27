<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class NetworkController extends Controller
{
    //
    public function index()
    {
        // ✅ Get the category named 'network' with its related products
        $category = Category::where('name', 'network')
            ->with('products')
            ->firstOrFail();

        // ✅ Pass to the view
        return view('FrontEnd.fcategory.network', compact('category'));
    }
}
