<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DCategoryAccessoriesController extends Controller
{
    public function index()
    {
        $categories = Category::with('products.images')->find(3); // eager load images
        return view('admin.category.accessories', compact('categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::with('images')->findOrFail($id);

        if ($product->category_id != 3) {
            return redirect()->back()->with('error', 'You can only edit products in Category 3.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'existing_images.*' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Update product info
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
        ]);

        // Delete removed images
        $existing = $request->existing_images ?? [];
        foreach ($product->images as $img) {
            if (!in_array($img->id, $existing)) {
                if (Storage::disk('public')->exists($img->image)) {
                    Storage::disk('public')->delete($img->image);
                }
                $img->delete();
            }
        }

        // Upload new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('products', 'public');
                $product->images()->create(['image' => $path]);
            }
        }

        return redirect()->route('admin.accessories.index')->with('success', 'Product updated successfully!');
    }
}
