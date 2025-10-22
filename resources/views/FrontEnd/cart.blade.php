@extends('layouts.app')

@section('title', 'Your Cart')

@section('content')
<div class="p-8 max-w-4xl mx-auto bg-white rounded-xl shadow-lg">
    <h1 class="text-2xl font-bold mb-6">Shopping Cart</h1>

    @php
        $cart = session('cart', []);
    @endphp

    @if(count($cart) > 0)
        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">Product</th>
                    <th class="border px-4 py-2">Quantity</th>
                    <th class="border px-4 py-2">Price</th>
                    <th class="border px-4 py-2">Subtotal</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $item)
                <tr>
                    <td class="border px-4 py-2">{{ $item['name'] }}</td>
                    <td class="border px-4 py-2">{{ $item['quantity'] }}</td>
                    <td class="border px-4 py-2">${{ number_format($item['price'], 2) }}</td>
                    <td class="border px-4 py-2">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                    <td class="border px-4 py-2">
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6 text-right">
            <p class="text-lg font-bold">
                Total: ${{ number_format(array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart)), 2) }}
            </p>
            <form action="{{ route('checkout') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold">
                    Checkout
                </button>
            </form>
        </div>

    @else
        <p class="text-gray-500">Your cart is empty.</p>
    @endif
</div>
@endsection
