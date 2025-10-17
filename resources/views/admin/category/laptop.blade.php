{{-- @extends('admin.app')

@section('title', 'Category 1 Products')

@section('content')
    <div class="p-8 bg-gray-100 min-h-screen">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Products in Category: {{ $categories->name }}</h1>

        <div class="bg-white rounded-2xl shadow overflow-hidden">
            <table class="min-w-full border-collapse">
                <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
                    <tr>
                        <th class="py-3 px-4 text-left">#</th>
                        <th class="py-3 px-4 text-left">Product Name</th>
                        <th class="py-3 px-4 text-left">Price</th>
                        <th class="py-3 px-4 text-left">Stock</th>
                        <th class="py-3 px-4 text-left">Image</th>
                        <th class="py-3 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($categories->products as $key => $product)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3 px-4 text-gray-700">{{ $key + 1 }}</td>
                            <td class="py-3 px-4 font-medium text-gray-800">{{ $product->name }}</td>
                            <td class="py-3 px-4 font-semibold text-green-600">${{ number_format($product->price, 2) }}</td>
                            <td class="py-3 px-4 text-gray-700">{{ $product->stock }}</td>
                            <td class="py-3 px-4">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-16 h-16 object-cover rounded-lg">
                                @else
                                    <span class="text-gray-400 text-sm">No image</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="#"
                                        class="bg-yellow-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-yellow-600 transition">Edit</a>

                                    <form action="{{ route('admin.dproduct.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 px-4 text-center text-gray-500">
                                No products in this category.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection --}}
@extends('admin.app')

@section('title', 'Category 1 Products')

@section('content')
    <div class="p-8 bg-gray-100 min-h-screen" x-data="{ showForm: false, product: {} }">

        <h1 class="text-3xl font-bold mb-6 text-gray-800">
            Products in Category: {{ $categories->name }}
        </h1>

        <div class="bg-white rounded-2xl shadow overflow-hidden">
            <table class="min-w-full border-collapse">
                <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
                    <tr>
                        <th class="py-3 px-4 text-left">#</th>
                        <th class="py-3 px-4 text-left">Product Name</th>
                        <th class="py-3 px-4 text-left">Price</th>
                        <th class="py-3 px-4 text-left">Stock</th>
                        <th class="py-3 px-4 text-left">Image</th>
                        <th class="py-3 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($categories->products as $key => $product)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3 px-4 text-gray-700">{{ $key + 1 }}</td>
                            <td class="py-3 px-4 font-medium text-gray-800">{{ $product->name }}</td>
                            <td class="py-3 px-4 font-semibold text-green-600">${{ number_format($product->price, 2) }}</td>
                            <td class="py-3 px-4 text-gray-700">{{ $product->stock }}</td>
                            <td class="py-3 px-4">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-16 h-16 object-cover rounded-lg">
                                @else
                                    <span class="text-gray-400 text-sm">No image</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-center">
                                <div class="flex justify-center space-x-2">
                                    <button
                                        @click="
                                            showForm = true;
                                            product = {
                                                id: {{ $product->id }},
                                                name: '{{ $product->name }}',
                                                description: '{{ $product->description }}',
                                                price: '{{ $product->price }}',
                                                stock: '{{ $product->stock }}',
                                                category_id: '{{ $product->category_id }}'
                                            };
                                        "
                                        class="bg-yellow-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-yellow-600 transition">
                                        Edit
                                    </button>

                                    <form action="{{ route('admin.dproduct.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 px-4 text-center text-gray-500">
                                No products in this category.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- ✅ Edit Product Popup Modal -->
        <div x-show="showForm" class="fixed inset-0 bg-gray-300/60 bg-opacity-50 flex items-center justify-center z-50"
            x-transition>
            <div class="bg-white rounded-2xl shadow-lg w-1/3 p-6 relative">

                <h2 class="text-xl font-semibold mb-4 text-gray-800">Edit Product</h2>

                <form :action="`/admin/dcategory-laptop/update/${product.id}`" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" x-model="product.name"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" x-model="product.description"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200"></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Price</label>
                                <input type="number" name="price" x-model="product.price"
                                    class="w-full border rounded-lg px-3 py-2" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Stock</label>
                                <input type="number" name="stock" x-model="product.stock"
                                    class="w-full border rounded-lg px-3 py-2" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Image</label>
                            <input type="file" name="image" class="w-full border rounded-lg px-3 py-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Category ID</label>
                            <input type="number" name="category_id" x-model="product.category_id"
                                class="w-full border rounded-lg px-3 py-2" required>
                        </div>

                        <div class="flex justify-end space-x-2 mt-4">
                            <button type="button" @click="showForm = false"
                                class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500">
                                Cancel
                            </button>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Close Button -->
                <button @click="showForm = false"
                    class="absolute top-3 right-3 text-gray-500 hover:text-gray-800 text-xl font-bold">
                    ×
                </button>
            </div>
        </div>

    </div>
@endsection
