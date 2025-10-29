<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $path = $imageFile->store('products', 'public');

                \App\Models\ProductImage::create([
                    'product_id' => $request->product_id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->back()->with('success', '✅ Images uploaded successfully!');
    }
}
