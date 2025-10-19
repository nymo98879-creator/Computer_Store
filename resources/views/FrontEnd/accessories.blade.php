
@extends('layouts.app')

@section('title', 'Accessories')

@section('content')
    <div class="p-8 bg-gray-100 min-h-screen">

        {{-- Category Info --}}
        <div id="category-card" class="text-center mb-10">
            <h2 class="text-5xl font-bold text-gray-800 mb-4">{{ $category->name }}</h2>
            <p class="text-gray-600">{{ $category->description ?? '' }}</p>
        </div>

        {{-- Product List --}}
        <div id="product-list" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($category->products as $product)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 group">
                    <div class="relative">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-60 object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>

                    <div class="p-4 space-y-2">
                        <h2 class="text-lg font-bold text-gray-800 truncate">{{ $product->name }}</h2>
                        <p class="text-sm text-gray-500 h-10 overflow-hidden">{{ $product->description }}</p>

                        <div class="flex items-center justify-between mt-3">
                            <span class="text-2xl font-extrabold text-green-600">
                                ${{ number_format($product->price, 2) }}
                            </span>
                            <button class="bg-indigo-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                                Add to Cart
                            </button>
                        </div>

                        <p class="text-xs text-gray-500 mt-1">Stock: {{ $product->stock }}</p>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500">
                    No products found in this category.
                </p>
            @endforelse
        </div>
    </div>
@endsection
