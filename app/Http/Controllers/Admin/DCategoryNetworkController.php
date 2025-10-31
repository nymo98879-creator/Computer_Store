<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage; // model for multiple images
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DCategoryNetworkController extends Controller
{
    // Show all Network products
    public function index()
    {
        // Assuming category ID for Network is 4, adjust as needed
        $category = Category::with('products.images')->find(4);

        return view('admin.category.network', compact('category'));
    }

    // Update a network product
    public function update(Request $request, $id)
    {
        $product = Product::with('images')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'existing_images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Update main product info
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
        ]);

        // Delete images removed from existing_images[]
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

        return redirect()->route('admin.network.index')->with('success', 'Network product updated successfully!');
    }

    // Delete a network product
    public function destroy($id)
    {
        $product = Product::with('images')->findOrFail($id);

        // Delete images from storage
        foreach ($product->images as $img) {
            if (Storage::disk('public')->exists($img->image)) {
                Storage::disk('public')->delete($img->image);
            }
            $img->delete();
        }

        $product->delete();

        return redirect()->route('admin.network.index')->with('success', 'Network product deleted successfully!');
    }
}
