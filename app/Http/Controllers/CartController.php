<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function view()
    {
        $cart = session('cart', []);
        return view('cart', compact('cart'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Get quantity from the form, default to 1
        $quantity = (int) $request->input('quantity', 1);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', "$quantity x $product->name added to cart!");
    }



    public function remove(Request $request ,$id)
    {


        // return redirect()->back()->with('success', 'Product removed from cart!');
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }

        // ✅ Keep cart open if user clicked "Cancel"
        if ($request->has('keep_cart_open')) {
            session(['keep_cart_open' => true]);
        }

        return redirect()->back();
    }
}
