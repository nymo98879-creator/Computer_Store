@extends('layouts.app')


@section('title', 'Products')

@section('content')
<div class="p-8">
    <h1 class="text-3xl font-bold mb-6">Products</h1>

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
</script>
@endsection
