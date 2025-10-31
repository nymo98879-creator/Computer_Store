<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage; // Make sure this model exists for multiple images
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DCategoyDesktopController extends Controller
{
    // Show products in desktop category
    public function index()
    {
        $categories = Category::with('products.images')->find(2); // load images too
        return view('admin.category.desktop', compact('categories'));
    }

    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'existing_images.*' => 'nullable|integer', // IDs of images to keep
        ]);

        // 1️⃣ Update product info
        $product->update($request->only('name', 'description', 'price', 'stock', 'category_id'));

        // 2️⃣ Delete images removed by user
        $existingImages = $request->input('existing_images', []); // IDs to keep
        foreach ($product->images as $img) {
            if (!in_array($img->id, $existingImages)) {
                if (Storage::exists('public/' . $img->image)) {
                    Storage::delete('public/' . $img->image);
                }
                $img->delete();
            }
        }

        // 3️⃣ Upload new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                ]);
            }
        }

        // 4️⃣ Update main product image if empty
        if ($product->images->count() > 0 && !$product->image) {
            $product->update(['image' => $product->images->first()->image]);
        }

        return redirect()
            ->route('admin.desktop.index')
            ->with('success', '✅ Product updated successfully!');
    }
}
