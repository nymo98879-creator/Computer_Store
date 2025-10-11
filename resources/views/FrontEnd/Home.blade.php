@extends('layouts.app')

@section('title', 'KM Store - Home')

@section('content')

<!-- Hero Section -->
<section class="relative w-full h-[70vh] bg-gradient-to-r from-gray-800 via-gray-700 to-gray-900 text-white flex items-center justify-center">
    <div class="text-center space-y-6">
        <h1 class="text-5xl font-extrabold tracking-tight">Welcome to <span class="text-blue-500">KM STORE</span></h1>
        <p class="text-lg text-gray-300 max-w-2xl mx-auto">Your one-stop destination for high-performance computers, gaming gear, and accessories.</p>
        <a href="{{ route('fproduct') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full font-semibold transition duration-300">Shop Now</a>
    </div>
</section>

<!-- Categories -->
<section class="py-16 bg-gray-100">
    <h2 class="text-4xl font-bold text-center mb-10 text-gray-800">Shop by Category</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 max-w-6xl mx-auto">
        <div class="bg-white shadow-lg rounded-2xl p-6 text-center hover:shadow-2xl transition duration-300">
            <img src="/images/laptop.jpg" alt="Laptops" class="mx-auto w-32 h-32 object-cover rounded-xl">
            <h3 class="mt-4 text-xl font-semibold text-gray-700">Laptops</h3>
        </div>
        <div class="bg-white shadow-lg rounded-2xl p-6 text-center hover:shadow-2xl transition duration-300">
            <img src="/images/desktop.jpg" alt="Desktops" class="mx-auto w-32 h-32 object-cover rounded-xl">
            <h3 class="mt-4 text-xl font-semibold text-gray-700">Desktops</h3>
        </div>
        <div class="bg-white shadow-lg rounded-2xl p-6 text-center hover:shadow-2xl transition duration-300">
            <img src="/images/accessory.jpg" alt="Accessories" class="mx-auto w-32 h-32 object-cover rounded-xl">
            <h3 class="mt-4 text-xl font-semibold text-gray-700">Accessories</h3>
        </div>
        <div class="bg-white shadow-lg rounded-2xl p-6 text-center hover:shadow-2xl transition duration-300">
            <img src="/images/monitor.jpg" alt="Monitors" class="mx-auto w-32 h-32 object-cover rounded-xl">
            <h3 class="mt-4 text-xl font-semibold text-gray-700">Monitors</h3>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="py-16 bg-white">
    <h2 class="text-4xl font-bold text-center mb-10 text-gray-800">Featured Products</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 max-w-7xl mx-auto">
        @foreach([1,2,3,4,5,6,7,8] as $product)
        <div class="bg-gray-50 shadow-lg rounded-2xl overflow-hidden hover:scale-105 transform transition duration-300">
            <img src="/images/product{{$product}}.jpg" alt="Product" class="w-full h-48 object-cover">
            <div class="p-5 text-center">
                <h3 class="text-lg font-semibold text-gray-800">Product Name {{ $product }}</h3>
                <p class="text-gray-600 mt-2">$999</p>
                <button class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-full font-medium transition duration-300">
                    Add to Cart
                </button>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Promotions / Banner -->
<section class="py-20 bg-gradient-to-r from-blue-700 to-blue-900 text-white text-center">
    <h2 class="text-4xl font-bold mb-4">Upgrade Your Gaming Setup Today</h2>
    <p class="text-gray-200 text-lg mb-6">Get up to 30% off on gaming accessories and high-end laptops!</p>
    <a href="{{ route('fproduct') }}" class="bg-white text-blue-700 px-8 py-3 rounded-full font-semibold hover:bg-gray-200 transition">Shop Deals</a>
</section>

@endsection
