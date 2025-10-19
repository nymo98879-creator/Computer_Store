@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="p-8 max-w-6xl mx-auto">

    <div class="flex flex-col md:flex-row gap-8">

        <!-- Product Image -->
        <div class="md:w-1/2">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-auto rounded-2xl shadow-lg">
        </div>

        <!-- Product Details -->
        <div class="md:w-1/2 space-y-4">
            <h1 class="text-4xl font-bold">{{ $product->name }}</h1>
            <p class="text-gray-600">{{ $product->description }}</p>
            <p class="text-green-600 text-2xl font-extrabold">${{ number_format($product->price, 2) }}</p>
            <p class="text-gray-700">Stock: {{ $product->stock }}</p>
            <p class="text-gray-500">Category: {{ $product->category->name ?? 'No Category' }}</p>

            <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                Add to Cart
            </button>
        </div>

    </div>

</div>
@endsection
