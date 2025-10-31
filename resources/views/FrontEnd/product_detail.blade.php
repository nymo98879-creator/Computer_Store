
@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="p-8 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="flex flex-col md:flex-row">

                <!-- 🖼 Product Image Gallery -->
                <div class="md:w-1/2 relative">
                    <!-- Main Image -->
                    <img id="mainImage"
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="w-full h-[400px] object-contain rounded-t-2xl md:rounded-l-2xl">

                    @if ($product->category)
                        <span
                            class="absolute top-4 left-4 bg-indigo-600 text-white text-xs font-semibold px-4 py-1 rounded-full shadow">
                            {{ $product->category->name }}
                        </span>
                    @endif

                    <!-- Thumbnail Images -->
                    @if ($product->images && $product->images->count() > 1)
                        <div class="flex gap-2 mt-4 justify-center flex-wrap p-4">
                            @foreach ($product->images as $img)
                                <img src="{{ asset('storage/' . $img->image) }}"
                                    class="w-20 h-20 object-cover rounded-lg border border-gray-200 cursor-pointer hover:ring-2 hover:ring-indigo-400 transition"
                                    onclick="document.getElementById('mainImage').src = this.src;">
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- 🧾 Product Details -->
                <div class="md:w-1/2 p-8 flex flex-col justify-between">
                    <div class="space-y-4">
                        <h1 class="text-4xl font-extrabold text-gray-800">{{ $product->name }}</h1>

                        <p class="text-gray-600 leading-relaxed text-justify whitespace-pre-line">
                            {{ $product->description }}
                        </p>

                        <div class="mt-4">
                            <span class="text-3xl font-bold text-green-600">
                                ${{ number_format($product->price, 2) }}
                            </span>
                        </div>

                        <p class="text-gray-600 text-sm">
                            <span class="font-semibold text-gray-800">Category:</span>
                            {{ $product->category->name ?? 'No Category' }}
                        </p>
                    </div>

                    <!-- 🛒 Add to Cart -->
                    @if ($product->stock > 0)
                        <div class="mt-8 flex flex-col sm:flex-row items-center gap-4">
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                <button type="button" id="decrease"
                                    class="px-4 py-2 text-gray-600 hover:bg-gray-100 text-lg">−</button>
                                <input type="number" id="quantity" name="quantity" min="1" value="1"
                                    class="w-16 text-center border-l border-r border-gray-300 focus:outline-none">
                                <button type="button" id="increase"
                                    class="px-4 py-2 text-gray-600 hover:bg-gray-100 text-lg">+</button>
                            </div>

                            <form id="addToCartForm" action="{{ route('product.cart', $product->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="quantity" id="hiddenQuantity" value="1">
                                <button type="submit"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition">
                                    <i class="fa-solid fa-cart-plus"></i> Add to Cart
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="mt-8">
                            <span class="text-red-600 font-semibold text-lg">Out of Stock</span>
                        </div>
                    @endif

                    <!-- 🔙 Back Button -->
                    @php
                        $backRoute = match (request()->query('from')) {
                            'home' => route('home'),
                            'laptop' => route('flaptop'),
                            'desktop' => route('fdesktop'),
                            'network' => route('fnetwork'),
                            'accessories' => route('faccessories'),
                            default => route('front.product'),
                        };
                    @endphp

                    <div class="mt-10">
                        <a href="{{ $backRoute }}"
                            class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-semibold text-sm transition">
                            <i class="fa-solid fa-arrow-left mr-2"></i> Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS for Quantity Control -->
    <script>
        const decreaseBtn = document.getElementById('decrease');
        const increaseBtn = document.getElementById('increase');
        const quantityInput = document.getElementById('quantity');
        const hiddenQuantity = document.getElementById('hiddenQuantity');

        function updateQuantity(value) {
            quantityInput.value = value;
            hiddenQuantity.value = value;
        }

        if (decreaseBtn && increaseBtn) {
            decreaseBtn.addEventListener('click', () => {
                let value = parseInt(quantityInput.value);
                if (value > 1) value--;
                updateQuantity(value);
            });

            increaseBtn.addEventListener('click', () => {
                let value = parseInt(quantityInput.value);
                value++;
                updateQuantity(value);
            });

            quantityInput.addEventListener('input', () => {
                let value = parseInt(quantityInput.value);
                if (isNaN(value) || value < 1) value = 1;
                updateQuantity(value);
            });
        }
    </script>
@endsection
