@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="p-8">

    <!-- Laptop Category -->
    @if($laptopCategory)
        <div class="mb-10 text-center">
            <h2 class="text-5xl font-bold mb-4">{{ $laptopCategory->name }}</h2>
            <p class="text-gray-600">{{ $laptopCategory->description ?? '' }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-20">
            @foreach($laptopCategory->products as $product)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 group">
                    <div class="relative">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                             class="w-full h-60 object-cover group-hover:scale-105 transition-transform duration-300">
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
            @endforeach
        </div>
    @endif

    <!-- Desktop Category -->
    @if($desktopCategory)
        <div class="mb-10 text-center">
            <h2 class="text-5xl font-bold mb-4">{{ $desktopCategory->name }}</h2>
            <p class="text-gray-600">{{ $desktopCategory->description ?? '' }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($desktopCategory->products as $product)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 group">
                    <div class="relative">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                             class="w-full h-60 object-cover group-hover:scale-105 transition-transform duration-300">
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
            @endforeach
        </div>
    @endif

</div>
@endsection
