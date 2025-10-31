@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <div class="p-8 bg-gray-50 min-h-screen">
        {{-- 💻 Laptop Category --}}
        @if ($laptopCategory)
            <section class="mb-20">
                <div class="text-center mb-10">
                    <h2 class="text-5xl font-extrabold text-gray-800 mb-4">
                        💻 {{ $laptopCategory->name }}
                    </h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        {{ $laptopCategory->description ?? 'Explore our latest collection of laptops with high performance and modern design.' }}
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8">
                    @foreach ($laptopCategory->products as $product)
                        <div
                            class="group bg-white rounded-2xl shadow-md hover:shadow-xl overflow-hidden transition-all duration-300 transform hover:-translate-y-1">
                            <div class="relative">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-500">

                                <!-- Quick View Overlay -->
                                <div
                                    class="absolute inset-0 flex items-center justify-center bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <a href="{{ route('product.show', $product->id) }}"
                                        class="bg-white text-gray-800 text-sm px-4 py-2 rounded-lg shadow-md font-semibold hover:bg-indigo-600 hover:text-white transition">
                                        View Details
                                    </a>
                                </div>
                            </div>

                            <div class="p-5">
                                <h2
                                    class="text-lg font-bold text-gray-800 truncate group-hover:text-indigo-600 transition-colors">
                                    {{ $product->name }}
                                </h2>
                                <p class="text-sm text-gray-500 mt-1 line-clamp-2">
                                    {{ $product->description }}
                                </p>

                                <div class="flex items-center justify-between mt-4">
                                    <span class="text-2xl font-bold text-green-600">
                                        ${{ number_format($product->price, 2) }}
                                    </span>
                                    {{-- <form action="{{ route('product.cart', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition">
                                            Add
                                        </button>
                                    </form> --}}
                                </div>

                                {{-- <p class="text-xs text-gray-500 mt-2">
                                    Stock: <span class="font-semibold text-gray-800">{{ $product->stock }}</span>
                                </p> --}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- 🖥️ Desktop Category --}}
        @if ($desktopCategory)
            <section class="mb-10">
                <div class="text-center mb-10">
                    <h2 class="text-5xl font-extrabold text-gray-800 mb-4">
                        🖥️ {{ $desktopCategory->name }}
                    </h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        {{ $desktopCategory->description ?? 'Powerful desktops built for gaming, design, and productivity.' }}
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8">
                    @foreach ($desktopCategory->products as $product)
                        <div
                            class="group bg-white rounded-2xl shadow-md hover:shadow-xl overflow-hidden transition-all duration-300 transform hover:-translate-y-1">
                            <div class="relative">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-500">

                                <!-- Quick View Overlay -->
                                <div
                                    class="absolute inset-0 flex items-center justify-center bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <a href="{{ route('product.show', $product->id) }}"
                                        class="bg-white text-gray-800 text-sm px-4 py-2 rounded-lg shadow-md font-semibold hover:bg-indigo-600 hover:text-white transition">
                                        View Details
                                    </a>
                                </div>
                            </div>

                            <div class="p-5">
                                <h2
                                    class="text-lg font-bold text-gray-800 truncate group-hover:text-indigo-600 transition-colors">
                                    {{ $product->name }}
                                </h2>
                                <p class="text-sm text-gray-500 mt-1 line-clamp-1">
                                    {{ $product->description }}
                                </p>

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

                                {{-- <p class="text-xs text-gray-500 mt-2">
                                    Stock: <span class="font-semibold text-gray-800">{{ $product->stock }}</span>
                                </p> --}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection
