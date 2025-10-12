 @extends('admin.app')

@section('title', 'Products')

@section('content')
    @vite(['resources/js/admin/product.js'])

    <div class="p-6 bg-gray-100 min-h-screen" x-data="{ showForm: false }">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Products</h1>
            {{-- <button @click="showForm = true"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                + Add Product
            </button> --}}
<a href=" {{ url('/create') }}">Add</a>
        </div>

        <!-- Table -->
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
                    <tr>
                        <th class="px-6 py-3">Image</th>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Price</th>
                        <th class="px-6 py-3">Stock</th>
                        <th class="px-6 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-3">
                            <img src="" class="w-14 h-14 rounded-lg object-cover" alt="">
                        </td>
                        <td class="px-6 py-3">Example Product</td>
                        <td class="px-6 py-3 text-green-600 font-semibold">$999</td>
                        <td class="px-6 py-3">20</td>
                        <td class="px-6 py-3 text-center">
                            <button
                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg shadow">Edit</button>
                            <button
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg shadow ml-2">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>


        </div>

        <!-- Popup Form -->
        {{-- <div x-show="showForm" x-transition.opacity
            class="fixed inset-0 bg-gray-500/50 bg-opacity-60 flex items-center justify-center z-50" x-cloak>
            <!-- Modal Box -->
            <div @click.away="showForm = false" x-transition.scale
                class="bg-white rounded-2xl shadow-2xl w-[90%] md:w-[500px] p-6 relative">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Add New Product</h2>

                <form action="{{ url('/products/store') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-600 mb-1">Product Name</label>
                        <input type="text" name="name"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Enter product name" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-600 mb-1">Price ($)</label>
                        <input type="number" name="price"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Enter price" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-600 mb-1">Stock</label>
                        <input type="number" name="stock"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Enter stock amount" required>
                    </div>
                    <div class="mb-4">
                        <select name="category_id" required>
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-600 mb-1">Product Image</label>
                        <input type="file" name="image" accept="image/*"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none" required>
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" @click="showForm = false"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                            Cancel
                        </button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div> --}}

    </div>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection

