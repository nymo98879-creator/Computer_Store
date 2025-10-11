@extends('layouts.app')

@section('title', 'Accessories')

@section('content')
<div class="max-w-7xl mx-auto">
    <h1 class="text-3xl font-bold mb-8 text-gray-800 text-center">Accessories</h1>

    <!-- Accessories Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
        @foreach (['Keyboard', 'Mouse', 'Headset', 'USB Drive', 'Charger', 'Cable', 'Bag', 'Stand'] as $item)
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden hover:scale-105 transition-transform">
            <img src="https://via.placeholder.com/300x200" alt="{{ $item }}" class="w-full h-48 object-cover">
            <div class="p-4 text-center">
                <h3 class="text-lg font-semibold">{{ $item }}</h3>
                <p class="text-blue-600 font-bold mt-1">$ {{ rand(5, 50) }}</p>
                <button class="mt-3 bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 w-full">
                    Add to Cart
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
