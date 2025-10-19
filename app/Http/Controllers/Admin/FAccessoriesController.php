<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class FAccessoriesController extends Controller
{
    //
    public function indexfront()
    {
        $category = Category::with('products')->find(3);
        return view('FrontEnd.accessories', compact('category'));
    }
}
