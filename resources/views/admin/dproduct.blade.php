@extends('admin.app')

@section('title', 'Product List')

@section('content')
    <div class="p-8 bg-gray-100 min-h-screen " x-data="{ showForm: false }">
        <!-- Header -->
        {{-- <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">🛍️ Product Management</h1> --}}
        {{-- <a href="{{ route('admin.products.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">
           + Add Product
        </a> --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Product</h1>
            <button @click="showForm = true"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                + Add Product
            </button>
        </div>
        {{-- </div> --}}

        <!-- Product Table -->
        <div class="bg-white rounded-2xl shadow overflow-hidden">
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
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3 px-4 text-gray-700">{{ $loop->iteration }}</td>

                            <td class="py-3 px-4">
                                {{-- <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="w-14 h-14 rounded-lg object-cover shadow-sm"> --}}
                                <img src="{{ asset('storage/' . $product->image) }}"
                                    class="w-16 h-16 rounded-lg object-cover">
                            </td>

                            <td class="py-3 px-4 font-medium text-gray-800">{{ $product->name }}</td>
                            <td class="py-3 px-4 text-gray-600 text-sm w-1/4 truncate">{{ $product->description }}</td>
                            <td class="py-3 px-4 font-semibold text-green-600">${{ number_format($product->price, 2) }}</td>
                            <td class="py-3 px-4 text-gray-700">{{ $product->stock }}</td>
                            <td class="py-3 px-4">
                                <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm">
                                    {{ $product->category->name ?? 'No Category' }}
                                </span>
                            </td>

                            <!-- Action buttons -->
                            <td class="py-3 px-4 text-center">
                                <div class="flex justify-center space-x-2">
                                    {{-- <a href="{{ route('admin.products.edit', $product->id) }}"
                                   class="bg-yellow-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-yellow-600 transition">
                                   ✏️ Edit
                                </a> --}}

                                    {{-- <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-red-600 transition">
                                        🗑 Delete
                                    </button>
                                </form> --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <!-- Popup Form -->
        <div x-show="showForm" x-transition.opacity
    class="fixed inset-0 bg-gray-500/50 flex items-center justify-center z-50" x-cloak>
    <!-- Modal Box -->
    <div @click.away="showForm = false" x-transition.scale
        class="bg-white rounded-2xl shadow-2xl w-[90%] md:w-[500px] p-6 relative">

        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Add New Product</h2>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            {{-- Product Name --}}
            <div>
                <label class="block text-gray-600 mb-1">Product Name</label>
                <input type="text" name="name"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Enter product name" required>
            </div>

           {{-- Description --}}
            <div>
                <label class="block text-gray-600 mb-1">Description</label>
                <textarea name="description" rows="4"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Enter product description"></textarea>
            </div>

            {{-- Price --}}
            <div>
                <label class="block text-gray-600 mb-1">Price ($)</label>
                <input type="number" name="price" step="0.01"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Enter price" required>
            </div>

            {{-- Stock --}}
            <div>
                <label class="block text-gray-600 mb-1">Stock</label>
                <input type="number" name="stock"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Enter stock amount" required>
            </div>

            {{-- Category Dropdown (optional) --}}
            <div>
                <label class="block text-gray-600 mb-1">Category</label>
                <select name="category_id"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Product Image --}}
            <div>
                <label class="block text-gray-600 mb-1">Product Image</label>
                <input type="file" name="image" accept="image/*"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none" required>
            </div>

            {{-- Buttons --}}
            <div class="flex justify-end gap-3 mt-4">
                <button type="button" @click="showForm = false"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                    Cancel
                </button>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

    </div>
@endsection
