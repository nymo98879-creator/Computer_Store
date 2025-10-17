@extends('layouts.app')


@section('title', 'Products')

@section('content')
    <div class="p-8">
        <h1 class="text-5xl text-center  font-bold mb-10">All Products</h1>

        <div id="product-list" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Products will be inserted here by JS -->
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Fetch products from API
        axios.get('/api/products')
            .then(function(response) {
                const products = response.data;
                const container = document.getElementById('product-list');

                products.forEach(product => {
                    const html = `

                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300 group">
                        <div class="relative">
                            <img src="/storage/${product.image}" alt="${product.name}" 
                                class="w-full h-60 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute top-2 right-2 bg-white/80 text-sm text-gray-700 px-3 py-1 rounded-full">
                                ${product.category ? product.category.name : 'No Category'}
                            </div>
                        </div>

                        <div class="p-4 space-y-2">
                            <h2 class="text-lg font-bold text-gray-800 truncate">${product.name}</h2>
                            <p class="text-sm text-gray-500 h-10 overflow-hidden">${product.description}</p>

                            <div class="flex items-center justify-between mt-3">
                                <span class="text-2xl font-extrabold text-green-600">$${parseFloat(product.price).toFixed(2)}</span>
                                <button class="bg-indigo-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                                    Add to Cart
                                </button>
                            </div>

                            <p class="text-xs text-gray-500 mt-1">Stock: ${product.stock}</p>
                        </div>
                    </div>

                `;
                    container.insertAdjacentHTML('beforeend', html);
                });
            })
            .catch(function(error) {
                console.error('Error fetching products:', error);
            });
    </script>
@endsection
{{-- // <div class="bg-white rounded-xl shadow p-4">
                    //     <img src="/storage/${product.image}" class="w-full h-48 object-cover rounded-lg mb-2">
                    //     <h2 class="text-lg font-semibold">${product.name}</h2>
                    //     <p class="text-gray-600">${product.description}</p>
                    //     <p class="text-green-600 font-bold">$${parseFloat(product.price).toFixed(2)}</p>
                    //     <p class="text-gray-700">Stock: ${product.stock}</p>
                    //     <p class="text-indigo-600">${product.category ? product.category.name : 'No Category'}</p>
                    // </div> --}}
