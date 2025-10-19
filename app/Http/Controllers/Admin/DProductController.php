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

    public function indexpiganate()
    {
        $products = Product::with('category')
            ->orderBy('id', 'asc')
            ->paginate(5); // 5 products per page

        $categories = Category::orderBy('name', 'asc')->get();

        return view('admin.dproduct', compact('products', 'categories'));
    }


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
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
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
    // p
    public function update(Request $request, $id)
    {
        // ✅ Find product
        $product = Product::findOrFail($id);

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
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
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
