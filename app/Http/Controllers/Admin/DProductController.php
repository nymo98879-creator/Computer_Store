<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DProductController extends Controller
{
    public function show($id)
    {
        // Get product with category and related images
        $product = Product::with(['category', 'images'])->findOrFail($id);

        return view('FrontEnd.product_detail', compact('product'));
    }

    // ===============================
    // 🧾 List Products (Paginate)
    // ===============================
    public function indexpiganate()
    {
        $products = Product::with(['category', 'images'])
            ->orderBy('id', 'asc')
            ->paginate(10);

        $categories = Category::orderBy('name', 'asc')->get();
        $lowStockProducts = Product::where('stock', '<=', 5)->get();

        return view('admin.dproduct', compact('products', 'categories', 'lowStockProducts'));
    }

    // ===============================
    // 🧾 List All Products (with search)
    // ===============================
    public function index(Request $request)
    {
        $search = $request->query('search', null);
        $query = Product::with(['category', 'images']);

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $products = $query->orderBy('id', 'asc')->paginate(10);
        $categories = Category::orderBy('name', 'asc')->get();
        $lowStockProducts = Product::where('stock', '<=', 5)->get();

        return view('admin.dproduct', compact('products', 'categories', 'lowStockProducts', 'search'));
    }

    // ===============================
    // ➕ Store New Product (with multiple images)
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        // ✅ Create product record first
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'image' => '', // Will set later with first image
        ]);

        // ✅ Save images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('products', 'public');

                // Save first image as main product image
                if ($index === 0) {
                    $product->update(['image' => $path]);
                }

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', '✅ Product added successfully with images!');
    }

    // ===============================
    // ✏️ Update Product (with images)
    // ===============================
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
        ]);

        // ✅ Update product info
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
        ]);

        // ✅ Replace old images if new ones uploaded
        if ($request->hasFile('images')) {
            // Delete old images from storage
            foreach ($product->images as $img) {
                if (Storage::exists('public/' . $img->image)) {
                    Storage::delete('public/' . $img->image);
                }
                $img->delete();
            }

            // Upload new images
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('products', 'public');

                if ($index === 0) {
                    $product->update(['image' => $path]);
                }

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', '✅ Product updated successfully!');
    }

    // ===============================
    // ❌ Delete Product (with images)
    // ===============================
    public function destroy($id)
    {
        $product = Product::with('images')->find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        // Delete all product images
        foreach ($product->images as $img) {
            if (Storage::exists('public/' . $img->image)) {
                Storage::delete('public/' . $img->image);
            }
            $img->delete();
        }

        // Delete main image
        if ($product->image && Storage::exists('public/' . $product->image)) {
            Storage::delete('public/' . $product->image);
        }

        $product->delete();

        return redirect()->back()->with('success', '🗑 Product and images deleted successfully!');
    }
}
