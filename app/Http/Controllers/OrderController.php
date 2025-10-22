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

    // public function store(Request $request)
    // {
    //     // ✅ Ensure user is logged in
    //     if (!$request->session()->has('user_logged_in')) {
    //         return redirect('/')->with('error', 'Please login first to place an order.');
    //     }

    //     $customerId = $request->session()->get('user_id');

    //     // ✅ Get cart from session
    //     $cart = session('cart', []);

    //     if (empty($cart)) {
    //         return back()->with('error', 'Your cart is empty!');
    //     }

    //     // ✅ Calculate total
    //     $totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

    //     // ✅ Create order
    //     $order = Order::create([
    //         'customer_id' => $customerId,
    //         'total_price' => $totalPrice,
    //         'status'      => 'Pending',
    //     ]);

    //     // ✅ Insert each cart item into order_items table
    //     foreach ($cart as $productId => $item) {
    //         OrderItem::create([
    //             'order_id'   => $order->id,
    //             'product_id' => $productId,  // ✅ no error
    //             'quantity'   => $item['quantity'],
    //             'price'      => $item['price'],
    //         ]);

    //         // Reduce stock
    //         $product = Product::find($productId);
    //         if ($product) {
    //             $product->decrement('stock', $item['quantity']);
    //         }
    //     }


    //     // ✅ Clear cart after order placed
    //     session()->forget('cart');

    //     return redirect()->back()->with('success', '✅ Order placed successfully!');
    // }
    public function store(Request $request)
    {
        // ✅ Check login via session from AdminController
        if (!$request->session()->has('user_logged_in')) {
            // User is not logged in, redirect to login popup trigger page or home
            return redirect('/')->with('error', 'Please login first to place an order.');
        }

        $customerId = $request->session()->get('user_id'); // get user id from session

        // ✅ Get cart
        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty!');
        }

        // ✅ Calculate total
        $totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        // ✅ Create order
        $order = Order::create([
            'customer_id' => $customerId,
            'total_price' => $totalPrice,
            'status'      => 'Pending',
        ]);

        // ✅ Create order items
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $productId,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);

            // Reduce stock
            $product = Product::find($productId);
            if ($product) {
                $product->decrement('stock', $item['quantity']);
            }
        }

        // ✅ Clear cart
        session()->forget('cart');

        // return redirect()->back()->with('success', '✅ Order placed successfully!');
        return redirect()->back()->with('order_success', 'Your order has been placed successfully!');
    }
}
