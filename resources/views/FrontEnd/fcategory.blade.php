@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold mb-8 text-gray-800 text-center">Shop by Category</h1>

    <!-- Categories -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @foreach (['Laptops', 'Phones', 'Headphones', 'Smartwatches', 'Monitors', 'Accessories'] as $category)
        <div class="bg-white shadow-lg rounded-2xl hover:bg-blue-50 hover:shadow-2xl transition-all">
            <img src="https://via.placeholder.com/400x250" alt="{{ $category }}" class="w-full h-56 object-cover rounded-t-2xl">
            <div class="p-5 text-center">
                <h3 class="text-xl font-semibold text-gray-800">{{ $category }}</h3>
                <p class="text-gray-500 mt-2">Explore our best {{ strtolower($category) }} collection.</p>
                <button class="mt-4 bg-blue-600 text-white px-5 py-2 rounded-xl hover:bg-blue-700">
                    View Products
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
