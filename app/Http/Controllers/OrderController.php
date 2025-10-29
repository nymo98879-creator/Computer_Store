<?php

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
        // ✅ Require login
        if (!$request->session()->has('user_logged_in')) {
            return redirect('/')->with('error', 'Please login first to place an order.');
        }

        $customerId = $request->session()->get('user_id');
        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty!');
        }

        // ✅ Validate product stock before creating order
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);

            if (!$product) {
                return back()->with('error', 'One of the products does not exist.');
            }

            if ($product->stock <= 0) {
                return back()->with('error', "{$product->name} is out of stock.");
            }

            if ($product->stock < $item['quantity']) {
                return back()->with('error', "Not enough stock for {$product->name}. Only {$product->stock} left.");
            }
        }

        // ✅ Calculate total price
        $totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        // ✅ Create new order
        $order = Order::create([
            'customer_id' => $customerId,
            'total_price' => $totalPrice,
            'status'      => 'Pending',
        ]);

        // ✅ Save order items & decrease stock
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);

            // Double-check stock again (for concurrency safety)
            if ($product->stock < $item['quantity']) {
                return back()->with('error', "Sorry, stock changed for {$product->name}. Try again.");
            }

            // Create order item
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $productId,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);

            // 🔻 Reduce stock safely
            $product->decrement('stock', $item['quantity']);
        }

        // ✅ Clear cart after order success
        session()->forget('cart');

        return redirect()->back()->with('order_success', 'Your order has been placed successfully!');
    }
}
