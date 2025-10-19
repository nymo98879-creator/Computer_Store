<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    //
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('FrontEnd.product_detail', compact('product'));
    }
}
