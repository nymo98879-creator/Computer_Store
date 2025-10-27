<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class DProductController extends Controller
{
    // ===============================
    // 🧾 List Products (Paginate)
    // ===============================
    public function indexpiganate()
    {
        $products = Product::with('category')
            ->orderBy('id', 'asc')
            ->paginate(10);

        $categories = Category::orderBy('name', 'asc')->get();

        // ✅ Get products with low stock (<=5)
        $lowStockProducts = Product::where('stock', '<=', 5)->get();

        // ✅ Return view with all data
        return view('admin.dproduct', compact('products', 'categories', 'lowStockProducts'));
    }

    // ===============================
    // 🧾 List All Products (non-paginated)
    // ===============================
    public function index(Request $request)
    {
        // ✅ Get search term or set default to null
        $search = $request->query('search', null);

        $query = Product::with('category');

        // ✅ Apply search filter if provided
        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        // ✅ Paginate results (10 per page)
        $products = $query->orderBy('id', 'asc')->paginate(10);

        $categories = Category::orderBy('name', 'asc')->get();

        // ✅ Low stock products (optional alert)
        $lowStockProducts = Product::where('stock', '<=', 5)->get();

        // ✅ Return view with all variables
        return view(
            'admin.dproduct',
            compact('products', 'categories', 'lowStockProducts', 'search')
        );

    }



    // ===============================
    // ➕ Store New Product
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.products.index')->with('success', '✅ Product added successfully!');
    }

    // ===============================
    // ✏️ Update Product
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // ✅ Replace image if new one is uploaded
        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path('storage/' . $product->image))) {
                unlink(public_path('storage/' . $product->image));
            }

            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        // ✅ Update product
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'image' => $product->image,
        ]);

        return redirect()->route('admin.products.index')->with('success', '✅ Product updated successfully!');
    }

    // ===============================
    // ❌ Delete Product
    // ===============================
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        // ✅ Delete image file if exists
        if ($product->image && file_exists(public_path('storage/' . $product->image))) {
            unlink(public_path('storage/' . $product->image));
        }

        $product->delete();

        return redirect()->back()->with('success', '🗑 Product deleted successfully!');
    }
}
