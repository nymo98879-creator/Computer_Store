@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="p-8">
    <h1 class="text-5xl text-center font-bold mb-10">All Products</h1>

    <div id="product-list" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($products as $product)
            <a href="{{ route('product.show', $product->id) }}">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300 group">
                    <div class="relative">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                             class="w-full h-60 object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute top-2 right-2 bg-white/80 text-sm text-gray-700 px-3 py-1 rounded-full">
                            {{ $product->category ? $product->category->name : 'No Category' }}
                        </div>
                    </div>

                    <div class="p-4 space-y-2">
                        <h2 class="text-lg font-bold text-gray-800 truncate">{{ $product->name }}</h2>
                        <p class="text-sm text-gray-500 h-10 overflow-hidden">{{ $product->description }}</p>

                        <div class="flex items-center justify-between mt-3">
                            <span class="text-2xl font-extrabold text-green-600">${{ number_format($product->price, 2) }}</span>
                            <button class="bg-indigo-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                                Add to Cart
                            </button>
                        </div>

                        <p class="text-xs text-gray-500 mt-1">Stock: {{ $product->stock }}</p>
                    </div>
                </div>
            </a>
        @empty
            <p class="text-center col-span-4">No products available.</p>
        @endforelse
    </div>
</div>
@endsection
