@extends('layouts.app')

@section('title', 'KM Store - Home')

@section('content')
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        /* ✅ Make the slider full width + full height */
        .swiper {
            width: 100%;
            height: 600px;
            /* full screen height */
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.9;
        }

        /* Optional overlay text */
        .slide-content {
            position: absolute;
            color: white;
            text-align: center;
            z-index: 10;
        }

        .slide-content h2 {
            font-size: 3rem;
            font-weight: bold;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5);
        }

        .autoplay-progress {
            position: absolute;
            right: 16px;
            bottom: 16px;
            z-index: 10;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: var(--swiper-theme-color);
        }

        .autoplay-progress svg {
            --progress: 0;
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            stroke-width: 4px;
            stroke: var(--swiper-theme-color);
            fill: none;
            stroke-dashoffset: calc(125.6px * (1 - var(--progress)));
            stroke-dasharray: 125.6;
            transform: rotate(-90deg);
        }
    </style>

    <!-- ✅ Swiper Container -->
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="https://picsum.photos/1920/1080?random=1" alt="Slide 1">
                <div class="slide-content">
                    <h2>Welcome to KM STORE</h2>
                </div>
            </div>
            <div class="swiper-slide">
                <img src="https://picsum.photos/1920/1080?random=2" alt="Slide 2">
                <div class="slide-content">
                    <h2>Find the Best Tech Products</h2>
                </div>
            </div>
            <div class="swiper-slide">
                <img src="https://picsum.photos/1920/1080?random=3" alt="Slide 3">
                <div class="slide-content">
                    <h2>Exclusive Discounts Up to 30%</h2>
                </div>
            </div>
        </div>

        <!-- Navigation & Pagination -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>

        <!-- Autoplay progress -->
        <div class="autoplay-progress">
            <svg viewBox="0 0 48 48">
                <circle cx="24" cy="24" r="20"></circle>
            </svg>
            <span></span>
        </div>
    </div>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Swiper Initialization -->
    <script>
        const progressCircle = document.querySelector(".autoplay-progress svg");
        const progressContent = document.querySelector(".autoplay-progress span");

        const swiper = new Swiper(".mySwiper", {
            spaceBetween: 30,
            centeredSlides: true,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            on: {
                autoplayTimeLeft(s, time, progress) {
                    progressCircle.style.setProperty("--progress", 1 - progress);
                    progressContent.textContent = `${Math.ceil(time / 1000)}s`;
                },
            },
        });
    </script>





    <section class="py-16 bg-white">
        <div>
            <h1 class="text-6xl font-bold text-center mb-5">Welcome to Computer store</h1>
        </div>
        <div class="p-8">


            {{-- ✅ Title --}}
            {{-- <h1 class="text-5xl text-center font-bold mb-10">
            @if (!empty($search))
                Search results for: <span class="text-indigo-600">"{{ $search }}"</span>
            @else
                Our Products
            @endif
        </h1> --}}

            {{-- ✅ Product Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-8">
                @forelse ($products as $product)
                    <div
                        class="group bg-white rounded-2xl shadow-md hover:shadow-xl overflow-hidden transition-all duration-300 transform hover:-translate-y-1">
                        <div class="relative">
                            <a href="{{ route('product.show', $product->id) }}">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-500">
                            </a>

                            <div
                                class="absolute top-3 left-3 bg-indigo-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-md">
                                {{ $product->category ? $product->category->name : 'Uncategorized' }}
                            </div>

                            <div
                                class="absolute inset-0 flex items-center justify-center bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <a {{-- href="{{ route('product.show', $product->id) }}" --}} href="{{ route('product.show', $product->id) }}?from=home"
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

                                {{-- ✅ Stock Status --}}
                                <p class="text-xs mt-2">
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
                    <p class="text-center text-gray-600 col-span-3 text-xl">No products found.</p>
                @endforelse
            </div>
        </div>
    </section>



    <!-- ✅ Promotion Section -->
    <section class="py-20 bg-gradient-to-r from-blue-700 to-blue-900 text-white text-center">
        <h2 class="text-4xl font-bold mb-4">Upgrade Your Gaming Setup Today</h2>
        <p class="text-gray-200 text-lg mb-6">Get up to 30% off on gaming accessories and high-end laptops!</p>
        <a href="{{ route('front.product') }}"
            class="bg-white text-blue-700 px-8 py-3 rounded-full font-semibold hover:bg-gray-200 transition">
            Shop Deals
        </a>
    </section>

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


        // const pageKey = window.location.pathname;

        // // Save scroll position when leaving the page
        // window.addEventListener("beforeunload", () => {
        //     localStorage.setItem("scrollPosition_" + pageKey, window.scrollY);
        // });

        // // Restore scroll position on load
        // window.addEventListener("load", () => {
        //     const scrollY = localStorage.getItem("scrollPosition_" + pageKey);
        //     if (scrollY) {
        //         window.scrollTo(0, parseInt(scrollY));
        //         localStorage.removeItem("scrollPosition_" + pageKey);
        //     }
        // });
    </script>

@endsection
