<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DCategoryAccessoriesController extends Controller
{
    //
    public function index()
    {
        $categories = Category::with('products')->find(3);
        return view('admin.category.accessories', compact('categories'));
    }
    //
    public function update(Request $request, $id)
    {
        // ✅ Find product
        $product = Product::findOrFail($id);
        if ($product->category_id != 3) {
            return redirect()->back()->with('error', 'You can only edit products in Category 3.');
        }

        // ✅ Validate inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // ✅ Update image if new one uploaded
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && file_exists(public_path('storage/' . $product->image))) {
                unlink(public_path('storage/' . $product->image));
            }

            // Store new image
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        // ✅ Update product data
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'image' => $product->image, // keep old or update with new
        ]);

        // ✅ Redirect back with success
        // return redirect()->route('admin.laptop.index')->with('success', 'Product updated successfully!');
        return redirect()
            ->route('admin.accessories.index')
            ->with('success', 'Product updated successfully!');
    }
}
