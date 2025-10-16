@extends('layouts.app')

@section('title', 'KM Store - Home')

@section('content')

    <!-- Hero Section -->
    <section
        class="relative w-full h-[70vh] bg-gradient-to-r from-gray-800 via-gray-700 to-gray-900 text-white flex items-center justify-center">
        <div class="text-center space-y-6">
            <h1 class="text-5xl font-extrabold tracking-tight">
                Welcome to <span class="text-blue-500">KM STORE</span>
            </h1>
            <p class="text-lg text-gray-300 max-w-2xl mx-auto">
                Your one-stop destination for high-performance computers, gaming gear, and accessories.
            </p>
            <a href="{{ route('fproduct') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full font-semibold transition duration-300">
                Shop Now
            </a>
        </div>
    </section>

    <!-- Categories -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-extrabold text-center text-gray-800 mb-12">
                Shop by <span class="text-blue-600">Category</span>
            </h2>

            <div id="category-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 px-32 gap-8">
                <!-- Categories will be loaded here -->
            </div>
        </div>
    </section>


    <!-- Products Section -->
    <section class="py-16 bg-white">
        <div class="p-8">
            <h1 class="text-5xl text-center font-bold mb-10">Our Products</h1>

            <div id="product-list" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Products will be inserted here by JS -->
            </div>
        </div>
    </section>

    <!-- Promotions / Banner -->
    <section class="py-20 bg-gradient-to-r from-blue-700 to-blue-900 text-white text-center">
        <h2 class="text-4xl font-bold mb-4">Upgrade Your Gaming Setup Today</h2>
        <p class="text-gray-200 text-lg mb-6">Get up to 30% off on gaming accessories and high-end laptops!</p>
        <a href="{{ route('fproduct') }}"
            class="bg-white text-blue-700 px-8 py-3 rounded-full font-semibold hover:bg-gray-200 transition">
            Shop Deals

        </a>
    </section>

    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // =========================
            // Fetch Products
            // =========================
            axios.get('/api/products')
                .then(function(response) {
                    const products = response.data;
                    const container = document.getElementById('product-list');

                    products.forEach(product => {
                        const html = `
                            <div class="bg-white rounded-xl shadow p-4">
                                <img src="/storage/${product.image}" class="w-full h-48 object-cover rounded-lg mb-2">
                                <h2 class="text-lg font-semibold">${product.name}</h2>
                                <p class="text-gray-600">${product.description}</p>
                                <p class="text-green-600 font-bold">$${parseFloat(product.price).toFixed(2)}</p>
                                <p class="text-gray-700">Stock: ${product.stock}</p>
                                <p class="text-indigo-600">${product.category ? product.category.name : 'No Category'}</p>
                            </div>
                        `;
                        container.insertAdjacentHTML('beforeend', html);
                    });
                })
                .catch(function(error) {
                    console.error('Error fetching products:', error);
                });

            // =========================
            // Fetch Categories
            // =========================
            axios.get('/api/categories')
                .then(response => {
                    const container = document.getElementById('category-container');
                    response.data.forEach(category => {
                        const imagesHtml = category.images.map(img =>
                            `<img src="/storage/${img}" class="w-40 h-40 object-cover rounded" />`
                        ).join('');

                        const cardHtml = `
                            <div class="bg-white rounded-xl h-[350px] shadow p-4 text-center hover:scale-105 transition-transform duration-300">
                                <h3 class="font-bold text-3xl mb-2">${category.name}</h3>
                                <div class="flex mt-10  h-[200px] justify-evenly gap-2">${imagesHtml}</div>
                                <div><a href="" class="bg-blue-500 px-3 py-2 rounded-xl text-white">Shop Now</a></div>
                            </div>
                        `;
                        container.innerHTML += cardHtml;
                    });
                })
                .catch(err => console.error(err));




        });
    </script>

@endsection
