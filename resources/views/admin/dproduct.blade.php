@extends('admin.app')

@section('title', 'Product List')

@section('content')
    <div class="p-8 bg-gray-100 min-h-screen" x-data="{
        showForm: false,
        showEditForm: false,
        editProduct: {}
    }">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6 ">
            <h1 class="text-3xl font-bold text-gray-800">Product</h1>
            <button @click="showForm = true"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition fixed ml-[69.50%]">
                + Add Product
            </button>
        </div>

        <!-- ✅ Low Stock Alert -->
        {{-- @if ($lowStockProducts->count() > 0)
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-4 mb-6 rounded-lg">
                ⚠️ <strong>{{ $lowStockProducts->count() }}</strong> product(s) are low or out of stock.
            </div>
        @endif --}}

        <form method="GET" action="{{ route('admin.products.index') }}" class="mb-4  flex justify-end fixed ml-[59%]">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search by product name..."
                class="border border-gray-300 rounded-l-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-lg">
                Search
            </button>

            @if ($search)
                <a href="{{ route('admin.products.index') }}"
                    class="ml-2 bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded-lg text-gray-800">
                    Reset
                </a>
            @endif
        </form>

        {{-- @if ($search)
            <h2 class="text-xl font-bold mb-2">Search Results for "{{ $search }}"</h2>
            @if ($products->count() > 0)
                <table class="min-w-full border-collapse mb-8">
                    <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
                        <tr>
                            <th class="py-3 px-4 text-left">#</th>
                            <th class="py-3 px-4 text-left">Image</th>
                            <th class="py-3 px-4 text-left">Name</th>
                            <th class="py-3 px-4 text-left">Price</th>
                            <th class="py-3 px-4 text-left">Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4">
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                        class="w-16 h-16 rounded-lg object-cover">
                                </td>
                                <td class="py-3 px-4">{{ $product->name }}</td>
                                <td class="py-3 px-4">${{ number_format($product->price, 2) }}</td>
                                <td class="py-3 px-4">
                                    @if ($product->stock <= 0)
                                        <span class="text-red-600 font-semibold">Out of Stock</span>
                                    @elseif($product->stock <= 5)
                                        <span class="text-yellow-600 font-semibold">Low ({{ $product->stock }})</span>
                                    @else
                                        <span class="text-green-600 font-semibold">In Stock ({{ $product->stock }})</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-600">No products found for "{{ $search }}"</p>
            @endif
        @endif --}}

        <!-- ✅ Product Table -->
        <div class="bg-white rounded-2xl shadow overflow-hidden mt-20">
            <table class="min-w-full border-collapse">
                <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
                    <tr>
                        <th class="py-3 px-4 text-left">#</th>
                        <th class="py-3 px-4 text-left">Image</th>
                        <th class="py-3 px-4 text-left">Name</th>
                        <th class="py-3 px-4 text-left">Description</th>
                        <th class="py-3 px-4 text-left">Price</th>
                        <th class="py-3 px-4 text-left">Stock</th>
                        <th class="py-3 px-4 text-left">Category</th>
                        <th class="py-3 px-4 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @foreach ($products as $product)
                        <tr
                            class="hover:bg-gray-50 transition 
                            {{ $product->stock <= 0 ? 'bg-red-50' : ($product->stock <= 5 ? 'bg-yellow-50' : '') }}">
                            <td class="py-3 px-4 text-gray-700">{{ $loop->iteration }}</td>

                            <!-- Product Image -->
                            <td class="py-3 px-4">
                                <img src="{{ asset('storage/' . $product->image) }}"
                                    class="w-16 h-16 rounded-lg object-cover">
                            </td>

                            <!-- Product Name -->
                            <td class="py-3 px-4 font-medium text-gray-800">{{ $product->name }}</td>

                            <!-- Description -->
                            <td class="py-3 px-4 text-gray-600 text-sm w-1/4 truncate whitespace-pre-line">
                                {{ $product->description }}
                            </td>

                            <!-- Price -->
                            <td class="py-3 px-4 font-semibold text-green-600">
                                ${{ number_format($product->price, 2) }}
                            </td>

                            <!-- Stock -->
                            <td class="py-3 px-4">
                                @if ($product->stock <= 0)
                                    <span class="text-red-600 font-semibold">Out of Stock</span>
                                @elseif ($product->stock <= 5)
                                    <span class="text-yellow-600 font-semibold">Low ({{ $product->stock }})</span>
                                @else
                                    <span class="text-green-600 font-semibold">In Stock ({{ $product->stock }})</span>
                                @endif
                            </td>

                            <!-- Category -->
                            <td class="py-3 px-4">
                                <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm">
                                    {{ $product->category->name ?? 'No Category' }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="py-3 px-4 text-center">
                                <div class="flex justify-center space-x-2">

                                    <!-- Edit Button -->
                                    <button
                                        @click="showEditForm = true;
                                        editProduct = {
                                            id: {{ $product->id }},
                                            name: '{{ addslashes($product->name) }}',
                                            description: '{{ addslashes($product->description) }}',
                                            price: {{ $product->price }},
                                            stock: {{ $product->stock }},
                                            category_id: {{ $product->category_id }},
                                            image: '{{ asset('storage/' . $product->image) }}'
                                        }"
                                        class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600 transition">
                                        Edit
                                    </button>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.dproduct.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600 transition">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- ✅ Pagination -->
            <div class="mt-6 flex justify-center">
                {{ $products->onEachSide(1)->links('pagination::tailwind') }}
            </div>
        </div>


        <!-- 🟦 Add Product Popup -->
        <div x-show="showForm" x-transition.opacity
            class="fixed inset-0 bg-gray-500/50 flex items-center justify-center z-50" x-cloak>
            <div @click.away="showForm = false" x-transition.scale
                class="bg-white rounded-2xl shadow-2xl w-[90%] md:w-[500px] p-6 relative" x-data="{ imagePreview: null }">

                <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Add New Product</h2>

                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf

                    <!-- Product Name -->
                    <div>
                        <label class="block text-gray-600 mb-1">Product Name</label>
                        <input type="text" name="name"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Enter product name" required>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-gray-600 mb-1">Description</label>
                        <textarea name="description" rows="3"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Short product description..."></textarea>
                    </div>

                    <!-- Price and Stock -->
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-gray-600 mb-1">Price ($)</label>
                            <input type="number" step="0.01" name="price"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="0.00" required>
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1">Stock</label>
                            <input type="number" name="stock"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="0" required>
                        </div>
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-gray-600 mb-1">Category</label>
                        <select name="category_id"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required>
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <!-- 🖼️ Multiple Image Upload with Preview -->
                    <div x-data="{ imagePreviews: [] }">
                        <label class="block text-gray-600 mb-1">Product Images</label>
                        <input type="file" name="images[]" accept="image/*" multiple
                            @change="
                                    imagePreviews = [];
                                    for (const file of $event.target.files) {
                                        imagePreviews.push(URL.createObjectURL(file));
                                    }
                                "
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none" required>

                        <!-- 🟢 Image Preview -->
                        <div class="mt-3 flex gap-2 flex-wrap">
                            <template x-for="(src, index) in imagePreviews" :key="index">
                                <img :src="src" class="w-20 h-20 rounded-lg object-cover border">
                            </template>
                        </div>
                    </div>
                    <!-- Image Upload with Preview -->
                    {{-- <div>
                        <label class="block text-gray-600 mb-1">Product Image</label>
                        <input type="file" name="image" accept="image/*"
                            @change="const file = $event.target.files[0];
                             if (file) imagePreview = URL.createObjectURL(file)"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none" required>

                        <template x-if="imagePreview">
                            <img :src="imagePreview" alt="Preview"
                                class="mt-3 w-28 h-28 rounded-lg object-cover border">
                        </template>
                    </div> --}}

                    <!-- Buttons -->
                    <div class="flex justify-end gap-3 mt-4">
                        <button type="button" @click="showForm = false"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                            Cancel
                        </button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            Save Product
                        </button>
                    </div>
                </form>
            </div>
        </div>


        <!-- 🟨 Edit Product Popup -->
        <div x-show="showEditForm" x-transition.opacity
            class="fixed inset-0 bg-gray-500/50 flex items-center justify-center z-50" x-cloak>
            <div @click.away="showEditForm = false" x-transition.scale
                class="bg-white rounded-2xl shadow-2xl w-[90%] md:w-[500px] p-6 relative">

                <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Edit Product</h2>

                <!-- ✅ Updated Form -->
                <form :action="`/admin/products/${editProduct.id}`" method="POST" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div>
                        <label class="block text-gray-600 mb-1">Product Name</label>
                        <input type="text" name="name" x-model="editProduct.name"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-gray-600 mb-1">Description</label>
                        <textarea name="description" rows="3" x-model="editProduct.description"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea><br><br>
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

                    <!-- Category -->
                    <div>
                        <label class="block text-gray-600 mb-1">Category</label>
                        <select name="category_id" x-model="editProduct.category_id"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Image -->
                    <div>
                        <label class="block text-gray-600 mb-1">Current Image</label>
                        <template x-if="editProduct.image">
                            <img :src="editProduct.image" class="w-24 h-24 rounded-lg mb-2 object-cover border">
                        </template>
                        <input type="file" name="image" accept="image/*"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none">
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
