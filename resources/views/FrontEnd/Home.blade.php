@extends('layouts.app')

@section('title', 'KM Store - Home')

@section('content')

    <!-- Hero Section -->
    <section
        class="relative w-full h-[70vh] bg-gradient-to-r from-gray-800 via-gray-700 to-gray-900 text-white flex items-center justify-center">
        <div class="text-center space-y-6">
            <h1 class="text-5xl font-extrabold tracking-tight">
                Welcome to <span class="text-blue-500">KM STORE</span>
            </h1>
            <p class="text-lg text-gray-300 max-w-2xl mx-auto">
                Your one-stop destination for high-performance computers, gaming gear, and accessories.
            </p>
            <a href="{{ route('front.product') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full font-semibold transition duration-300">
                Shop Now
            </a>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-extrabold text-center text-gray-800 mb-12">
                Shop by <span class="text-blue-600">Category</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-10">
                @foreach ($categories as $category)
                    <div
                        class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 text-center group p-6">

                        <!-- Show first 2 product images for this category -->
                        <div class="flex justify-center gap-3 mb-6">
                            @if ($category->products->count() > 0)
                                @foreach ($category->products->take(2) as $product)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-32 h-32 object-cover rounded-lg shadow-md transform group-hover:scale-105 transition duration-300">
                                @endforeach
                            @else
                                <div class="w-full h-32 bg-gray-200 flex items-center justify-center text-gray-500">
                                    No Images
                                </div>
                            @endif
                        </div>

                        <!-- Category Info -->
                        <h3 class="font-bold text-2xl text-gray-800 mb-4 group-hover:text-blue-600 transition">
                            {{ $category->name }}</h3>
                        @if (!empty($category->description))
                            <p class="text-sm text-gray-500 mb-4 h-16 overflow-hidden">{{ $category->description }}</p>
                        @endif
                        <a href="{{ route('front.product') }}"
                            class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-full font-semibold transition">
                            Shop Now
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- Products Section -->
    <section class="py-16 bg-white">
        <div class="p-8">
            <h1 class="text-5xl text-center font-bold mb-10">Our Products</h1>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-8">
                @foreach ($products->take(6) as $product)
                    <div
                        class="group bg-white rounded-2xl shadow-md hover:shadow-xl overflow-hidden transition-all duration-300 transform hover:-translate-y-1">

                        <!-- Product Image -->
                        <div class="relative">
                            <a href="{{ route('product.show', $product->id) }}">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-500">
                            </a>

                            <!-- Category Badge -->
                            <div
                                class="absolute top-3 left-3 bg-indigo-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-md">
                                {{ $product->category ? $product->category->name : 'Uncategorized' }}
                            </div>

                            <!-- Quick View Button (hover) -->
                            <div
                                class=" absolute inset-0 flex items-center justify-center bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <a href="{{ route('product.show', $product->id) }}"
                                    class="bg-white text-gray-800 text-sm px-4 py-2 rounded-lg shadow-md font-semibold hover:bg-indigo-600 hover:text-white transition">
                                    View Details
                                </a>
                            </div>
                        </div>

                        <!-- Product Info -->
                        <div class="p-5">
                            <h2
                                class="text-lg font-bold text-gray-800 truncate group-hover:text-indigo-600 transition-colors">
                                {{ $product->name }}
                            </h2>
                            <p class="text-sm text-gray-500 mt-1 line-clamp-2">
                                {{ $product->description }}
                            </p>

                            <!-- Price & Cart -->
                            <div class="flex items-center justify-between mt-4">
                                <span class="text-2xl font-bold text-green-600">
                                    ${{ number_format($product->price, 2) }}
                                </span>

                                <form action="{{ route('product.cart', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition">
                                        Add
                                    </button>
                                </form>
                            </div>

                            <p class="text-xs text-gray-500 mt-2">
                                Stock:
                                <span class="font-semibold text-gray-800">{{ $product->stock }}</span>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Promotions / Banner -->
    <section class="py-20 bg-gradient-to-r from-blue-700 to-blue-900 text-white text-center">
        <h2 class="text-4xl font-bold mb-4">Upgrade Your Gaming Setup Today</h2>
        <p class="text-gray-200 text-lg mb-6">Get up to 30% off on gaming accessories and high-end laptops!</p>
        <a href="{{ route('front.product') }}"
            class="bg-white text-blue-700 px-8 py-3 rounded-full font-semibold hover:bg-gray-200 transition">
            Shop Deals
        </a>
    </section>

@endsection
