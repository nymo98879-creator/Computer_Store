<?php
// app/Http/Controllers/Admin/DProductController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class DProductController extends Controller
{
    // public function index()
    // {
    //     // Get all products with their category
    //     $products = Product::with('category')->get();
    //     // dd($products);
    //     // dd($products->toArray());

    //     // Pass data to the 'admin.dproduct' view
    //     return view('admin.dproduct', compact('products'));
    // }
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category')->get();
        return view('admin.dproduct', compact('products', 'categories'));
    }
    // Show the create form
    // public function create()
    // {
    //     $categories = Category::all();
    //     return view('admin.product-create', compact('categories'));
    // }

    // Store new product
    public function store(Request $request)
    {
        // ✅ Validate inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ✅ Save image
        $imagePath = $request->file('image')->store('products', 'public');

        // ✅ Create product
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'image' => $imagePath,
        ]);

        // ✅ Redirect back
        return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
    }
}
