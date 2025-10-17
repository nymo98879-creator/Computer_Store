@extends('layouts.app')

@section('title', 'Category')

@section('content')
    <div id="category-card"></div>
    <div id="product-list" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6"></div>


    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        async function fetchCategoryWithProducts() {
            try {
                const response = await axios.get('/api/categories/3'); // API endpoint
                const category = response.data;

                // Display category info
                const catContainer = document.getElementById('category-card');
                catContainer.innerHTML = `
            <h2 class="text-5xl text-center mb-10 font-bold">${category.name}</h2>
            <p>${category.description || ''}</p>
        `;

                // Display products
                const prodContainer = document.getElementById('product-list');
                prodContainer.innerHTML = '';
                category.products.forEach(product => {
                    const html = `
                
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 group">
                    <div class="relative">
                        <img src="/storage/${product.image}" alt="${product.name}" 
                            class="w-full h-60 object-cover group-hover:scale-105 transition-transform duration-300">
                       
                    </div>

                    <div class="p-4 space-y-2">
                        <h2 class="text-lg font-bold text-gray-800 truncate">${product.name}</h2>
                        <p class="text-sm text-gray-500 h-10 overflow-hidden">${product.description}</p>

                        <div class="flex items-center justify-between mt-3">
                            <span class="text-2xl font-extrabold text-green-600">
                                $${parseFloat(product.price).toFixed(2)}
                            </span>
                            <button class="bg-indigo-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                                Add to Cart
                            </button>
                        </div>

                        <p class="text-xs text-gray-500 mt-1">Stock: ${product.stock}</p>
                    </div>
                </div>
            `;
                    prodContainer.insertAdjacentHTML('beforeend', html);
                });

            } catch (error) {
                console.error('Error fetching category:', error);
            }
        }

        fetchCategoryWithProducts();
    </script>

@endsection
