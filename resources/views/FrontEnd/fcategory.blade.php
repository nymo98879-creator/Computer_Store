@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="p-8">
    <!-- Category 1 -->
    <div id="category-card1" class="mb-10 text-center"></div>
    <div id="product-list1" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-20"></div>

    <!-- Category 2 -->
    <div id="category-card2" class="mb-10 text-center"></div>
    <div id="product-list2" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // Reusable function to fetch and render category with products
    async function fetchCategoryWithProducts(categoryId, cardId, listId) {
        try {
            const response = await axios.get(`/api/categories/${categoryId}`);
            const category = response.data;

            // Category header
            const catContainer = document.getElementById(cardId);
            catContainer.innerHTML = `
                <h2 class="text-5xl font-bold mb-4">${category.name}</h2>
                <p class="text-gray-600">${category.description || ''}</p>
            `;

            // Product cards
            const prodContainer = document.getElementById(listId);
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

    // Fetch two categories (you can add more if needed)
    fetchCategoryWithProducts(1, 'category-card1', 'product-list1');
    fetchCategoryWithProducts(2, 'category-card2', 'product-list2');
</script>
@endsection

 {{-- <div class="bg-white rounded-xl shadow p-4">
                    <img src="/storage/${product.image}" class="w-full h-48 object-cover rounded-lg mb-2">
                    <h3 class="text-lg font-semibold">${product.name}</h3>
                    <p class="text-gray-600">${product.description}</p>
                    <p class="text-green-600 font-bold">$${parseFloat(product.price).toFixed(2)}</p>
                    <p class="text-gray-700">Stock: ${product.stock}</p>
                </div> --}}
 {{-- <div class="absolute top-2 right-2 bg-white/80 text-sm text-gray-700 px-3 py-1 rounded-full">
                            ${product.category ? product.category.name : 'No Category'}
                        </div> --}}
