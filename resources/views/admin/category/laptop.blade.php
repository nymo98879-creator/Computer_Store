@extends('admin.app')

@section('title', 'Category 1 Products')

@section('content')
    <div class="p-8 bg-gray-100 min-h-screen" x-data="{
        showForm: false,
        showEditForm: false,
        editProduct: {}
    }">

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
                                            showEditForm = true;
                                            editProduct = {
                                                id: {{ $product->id }},
                                                name: '{{ addslashes($product->name) }}',
                                                description: '{{ addslashes($product->description) }}',
                                                price: {{ $product->price }},
                                                stock: {{ $product->stock }},
                                                category_id: {{ $product->category_id }},
                                                image: '{{ $product->image ? asset('storage/' . $product->image) : '' }}'
                                            };"
                                        class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600 transition">
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
        <div x-show="showEditForm" x-transition.opacity
            class="fixed inset-0 bg-gray-500/50 flex items-center justify-center z-50" x-cloak>
            <div @click.away="showEditForm = false" x-transition.scale
                class="bg-white rounded-2xl shadow-2xl w-[90%] md:w-[500px] p-6 relative" x-data="{ imagePreview: null }">

                <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Edit Accessory</h2>

                <!-- Edit Form -->
                <form :action="`/admin/dcategory-laptop/update/${editProduct.id}`" method="POST"
                    enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div>
                        <label class="block text-gray-600 mb-1">Accessory Name</label>
                        <input type="text" name="name" x-model="editProduct.name"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-gray-600 mb-1">Description</label>
                        <textarea name="description" rows="3" x-model="editProduct.description"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                    </div>

                    <!-- Price & Stock -->
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-gray-600 mb-1">Price ($)</label>
                            <input type="number" step="0.01" name="price" x-model="editProduct.price"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                required>
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1">Stock</label>
                            <input type="number" name="stock" x-model="editProduct.stock"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                required>
                        </div>
                    </div>

                    <!-- Category ID (fixed as accessories) -->
                    <div>
                        <label class="block text-gray-600 mb-1">Category ID</label>
                        <input type="number" name="category_id" x-model="editProduct.category_id"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            readonly>
                    </div>

                    <!-- Image Upload with Preview -->
                    <div>
                        <label class="block text-gray-600 mb-1">Accessory Image</label>
                        <input type="file" name="image" accept="image/*"
                            @change="const file = $event.target.files[0]; if(file) imagePreview = URL.createObjectURL(file)"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none">

                        <!-- Show existing image if no new image selected -->
                        <template x-if="!imagePreview && editProduct.image">
                            <img :src="editProduct.image" class="mt-2 w-28 h-28 rounded-lg object-cover border">
                        </template>

                        <!-- Preview new image -->
                        <template x-if="imagePreview">
                            <img :src="imagePreview" class="mt-2 w-28 h-28 rounded-lg object-cover border">
                        </template>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end gap-3 mt-4">
                        <button type="button" @click="showEditForm = false"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                            Cancel
                        </button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            Update
                        </button>
                    </div>
                </form>


            </div>
        </div>


    </div>
@endsection
