@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="max-w-7xl mx-auto">
    <h1 class="text-3xl font-bold mb-8 text-gray-800 text-center">Our Products</h1>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach (range(1,8) as $i)
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden hover:scale-105 transition-transform">
            <img src="https://via.placeholder.com/300x200" alt="Product Image" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-2">Product {{ $i }}</h3>
                <p class="text-gray-600 mb-2">High quality product for your need.</p>
                <p class="text-blue-600 font-bold text-lg mb-3">$ {{ rand(10, 100) }}</p>
                <button class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 w-full">
                    <i class="fa-solid fa-cart-plus mr-2"></i>Add to Cart
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
