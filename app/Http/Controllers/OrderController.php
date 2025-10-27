<?php
// app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('customer')->get();
        $count = $orders->count();
        return view('admin.order', compact('orders', 'count'));
    }

    public function store(Request $request)
    {
        // ✅ Check login
        if (!$request->session()->has('user_logged_in')) {
            return redirect('/')->with('error', 'Please login first to place an order.');
        }

        $customerId = $request->session()->get('user_id');
        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty!');
        }

        // ✅ Check stock for each product before ordering
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);

            if (!$product) {
                return back()->with('error', 'One of the products does not exist.');
            }

            if ($product->stock < $item['quantity']) {
                return back()->with('error', "Not enough stock for {$product->name}. Only {$product->stock} left.");
            }
        }

        // ✅ Create order
        $totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $order = Order::create([
            'customer_id' => $customerId,
            'total_price' => $totalPrice,
            'status'      => 'Pending',
        ]);

        // ✅ Create order items and decrease stock
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);

            // Create order item
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $productId,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);

            // 🔻 Decrease product stock safely
            $product->decrement('stock', $item['quantity']);
        }

        // ✅ Clear cart after ordering
        session()->forget('cart');

        return redirect()->back()->with('order_success', 'Your order has been placed successfully!');
    }
}
