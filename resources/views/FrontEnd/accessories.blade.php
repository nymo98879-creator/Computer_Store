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
                <div class="bg-white rounded-xl shadow p-4">
                    <img src="/storage/${product.image}" class="w-full h-48 object-cover rounded-lg mb-2">
                    <h3 class="text-lg font-semibold">${product.name}</h3>
                    <p class="text-gray-600">${product.description}</p>
                    <p class="text-green-600 font-bold">$${parseFloat(product.price).toFixed(2)}</p>
                    <p class="text-gray-700">Stock: ${product.stock}</p>
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
