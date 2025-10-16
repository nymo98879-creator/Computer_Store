<?php
// app/Http/Controllers/Admin/DProductController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DProductController extends Controller
{


    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category')->get();
        return view('admin.dproduct', compact('products', 'categories'));
    }

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

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully!');
    }
}
