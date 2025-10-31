@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <div class="p-8 bg-gray-50 min-h-screen">
        <h1 class="text-5xl text-center font-extrabold mb-10 text-gray-800 tracking-tight">
            All Products
        </h1>

        <div id="product-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse ($products as $product)
                <div
                    class="group bg-white rounded-2xl shadow-md hover:shadow-xl overflow-hidden transition-all duration-300 transform hover:-translate-y-1">

                    <!-- Product Image -->
                    <div class="relative">
                        <a href="{{ route('product.show', $product->id) }}">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class=" w-full h-80 object-contain group-hover:scale-105 transition-transform duration-500">
                        </a>

                        <!-- Category Badge -->
                        <div
                            class="absolute top-3 left-3 bg-indigo-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-md">
                            {{ $product->category ? $product->category->name : 'Uncategorized' }}
                        </div>

                        <!-- Quick View Button (hover) -->
                        <div
                            class=" absolute inset-0 flex items-center justify-center bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <a {{-- href="{{ route('product.show', $product->id) }}" --}} href="{{ route('product.show', $product->id) }}?from=product"
                                class="bg-white text-gray-800 text-sm px-4 py-2 rounded-lg shadow-md font-semibold hover:bg-indigo-600 hover:text-white transition">
                                View Details
                            </a>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="p-5">
                        <h2 class="text-lg font-bold text-gray-800 truncate group-hover:text-indigo-600 transition-colors">
                            {{ $product->name }}
                        </h2>
                        <p class="text-sm text-gray-500 mt-1 line-clamp-1">
                            {{ $product->description }}
                        </p>

                        <!-- Price & Cart -->
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-2xl font-bold text-green-600">
                                ${{ number_format($product->price, 2) }}
                            </span>

                            <!-- Stock Status -->
                            <p class="text-xs mt-2 ">
                                <span
                                    class="font-semibold
                                    {{ $product->stock <= 0 ? 'text-white bg-red-500 px-3 py-2 rounded-2xl' : ($product->stock <= 5 ? 'text-white bg-yellow-600 px-3 py-2 rounded-2xl' : 'text-white bg-green-600 px-3 py-2 rounded-2xl') }}">
                                    {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                                </span>
                            </p>
                        </div>

                    </div>
                </div>
            @empty
                <p class="text-center col-span-4 text-gray-600">No products available.</p>
            @endforelse
        </div>
    </div>
    <script>
        // ✅ Save scroll position before leaving the page
        window.addEventListener("beforeunload", () => {
            localStorage.setItem("scrollPosition", window.scrollY);
        });

        // ✅ Restore scroll position when coming back
        window.addEventListener("load", () => {
            const scrollPosition = localStorage.getItem("scrollPosition");
            if (scrollPosition) {
                window.scrollTo(0, parseInt(scrollPosition));
                localStorage.removeItem("scrollPosition"); // clear after using
            }
        });
    </script>


@endsection
