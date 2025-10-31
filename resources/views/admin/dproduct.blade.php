@extends('admin.app')

@section('title', 'Product List')

@section('content')
    <div class="p-8 bg-gray-100 min-h-screen" x-data="{
        showForm: false,
        showEditForm: false,
        editProduct: {}
    }">

        <!-- Header -->
        <div class="flex items-center justify-between mb-4 ">
            <h1 class="text-3xl font-bold text-gray-800">Product</h1>
            <button @click="showForm = true"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition fixed ml-[69.75%]">
                + Add Product
            </button>
        </div>

        <!-- ✅ Low Stock Alert -->

        <div class="flex">
            <div class="w-[50%]">
                @if ($lowStockProducts->count() > 0)
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-2 mb-4 rounded-lg">
                        ⚠️ <strong>{{ $lowStockProducts->count() }}</strong> product(s) are low or out of stock.
                    </div>
                @endif
            </div>
            <div class="w-[50%]">
                <form method="GET" action="{{ route('admin.products.index') }}" class="  flex justify-end ">
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
            </div>
        </div>



        <!-- ✅ Product Table -->
        <div class="bg-white rounded-2xl shadow overflow-hidden ">
            <!-- Table Wrapper with Fixed Header -->
            <div class="overflow-y-auto max-h-[475px]">
                <table class="min-w-full border-collapse">
                    <thead class="bg-gray-200 text-gray-700 uppercase text-sm sticky top-0 ">
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
                                class="hover:bg-gray-50 transition {{ $product->stock <= 0 ? 'bg-red-50' : ($product->stock <= 5 ? 'bg-yellow-50' : '') }}">
                                <td class="py-3 px-4 text-gray-700">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4">
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                        class="w-30 h-30 rounded-lg object-cover">
                                </td>
                                <td class="py-3 px-4 font-medium text-gray-800">{{ $product->name }}</td>
                                <td class="py-3 px-4  text-gray-600 text-sm w-1/4 truncate whitespace-pre-line   ">
                                    {{ $product->description }}</td>
                                <td class="py-3 px-4 font-semibold text-green-600">${{ number_format($product->price, 2) }}
                                </td>
                                <td class="py-3 px-4">
                                    @if ($product->stock <= 0)
                                        <span class="text-red-600 font-semibold">Out of Stock</span>
                                    @elseif($product->stock <= 5)
                                        <span class="text-yellow-600 font-semibold">Low ({{ $product->stock }})</span>
                                    @else
                                        <span class="text-green-600 font-semibold">In Stock ({{ $product->stock }})</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm">
                                        {{ $product->category->name ?? 'No Category' }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <div class="flex justify-center space-x-2">
                                        {{-- <button @click="showEditForm = true; editProduct = { ... }"
                                                class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600 transition">Edit</button> --}}
                                        <button
                                            @click="showEditForm = true; editProduct = {{ json_encode($product->load('images')) }}"
                                            class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600 transition">
                                            Edit
                                        </button>

                                        <form action="{{ route('admin.dproduct.destroy', $product->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600 transition">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
            <!-- Pagination -->
            <div class="mt-2 mb-3 flex justify-center">
                <div class="flex items-center gap-2 bg-white px-4 py-3 rounded-xl shadow-md">
                    @if ($products->onFirstPage())
                        <span class="px-3 py-2 text-gray-400 cursor-not-allowed text-sm rounded-lg bg-gray-100">
                            <i class="fa-solid fa-angle-left"></i>
                        </span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}"
                            class="px-3 py-2 text-indigo-600 hover:bg-indigo-50 text-sm rounded-lg transition">
                            <i class="fa-solid fa-angle-left"></i>
                        </a>
                    @endif

                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                        @if ($page == $products->currentPage())
                            <span class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow-sm font-semibold text-sm">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                                class="px-4 py-2 rounded-lg text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}"
                            class="px-3 py-2 text-indigo-600 hover:bg-indigo-50 text-sm rounded-lg transition">
                            <i class="fa-solid fa-angle-right"></i>
                        </a>
                    @else
                        <span class="px-3 py-2 text-gray-400 cursor-not-allowed text-sm rounded-lg bg-gray-100">
                            <i class="fa-solid fa-angle-right"></i>
                        </span>
                    @endif
                </div>
            </div>

            {{-- <div class="mt-5 flex justify-center mb-5 ">
                {{ $products->onEachSide(1)->links('pagination::tailwind') }}
            </div> --}}

        </div>



        <!-- 🟦 Add Product Popup -->
        <div x-show="showForm" x-transition.opacity
            class="fixed inset-0 bg-gray-500/50 flex items-center justify-center z-50" x-cloak>
            <div @click.away="showForm = false" x-transition.scale
                class="bg-white rounded-2xl shadow-2xl w-[90%] md:w-[500px] p-6 relative" x-data="{ imagePreview: null }">

                <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Add New Product</h2>

                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-2">
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
                class="bg-white rounded-2xl shadow-2xl w-[90%] md:w-[500px] p-6 relative" x-data="{ imagePreviews: [], newImages: [] }">

                <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Edit Product</h2>

                <form :action="`/admin/products/${editProduct.id}`" method="POST" enctype="multipart/form-data"
                    class="space-y-2">
                    @csrf
                    @method('PUT')

                    <!-- Product Name -->
                    <div>
                        <label class="block text-gray-600 mb-1">Product Name</label>
                        <input type="text" name="name" x-model="editProduct.name"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Enter product name" required>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-gray-600 mb-1">Description</label>
                        <textarea name="description" rows="3" x-model="editProduct.description"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Short product description..."></textarea>
                    </div>

                    <!-- Price and Stock -->
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-gray-600 mb-1">Price ($)</label>
                            <input type="number" step="0.01" name="price" x-model="editProduct.price"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="0.00" required>
                        </div>
                        <div>
                            <label class="block text-gray-600 mb-1">Stock</label>
                            <input type="number" name="stock" x-model="editProduct.stock"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="0" required>
                        </div>
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-gray-600 mb-1">Category</label>
                        <select name="category_id" x-model="editProduct.category_id"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required>
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Existing Images Preview -->
                    <div class="mt-3 flex gap-2 flex-wrap">
                        <template x-for="(img, index) in editProduct.images" :key="img.id">
                            <div class="relative">
                                <img :src="`/storage/${img.image}`" class="w-20 h-20 rounded-lg object-contain border">

                                <button type="button" @click="editProduct.images.splice(index, 1)"
                                    class="absolute top-[-10] right-[-10] bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">×</button>

                                <!-- Hidden input to keep track of existing images -->
                                <input type="hidden" name="existing_images[]" :value="img.id">
                            </div>
                        </template>
                    </div>

                    <!-- Upload New Images -->
                    <div x-data>
                        <label class="block text-gray-600 mb-1 mt-2">Add New Images</label>
                        <input type="file" name="images[]" accept="image/*" multiple
                            @change="
                        newImages = [];
                        imagePreviews = [];
                        for (const file of $event.target.files) {
                            newImages.push(file);
                            imagePreviews.push(URL.createObjectURL(file));
                        }
                    "
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none">

                        <!-- Preview New Images -->
                        <div class="mt-3 flex gap-2 flex-wrap">
                            <template x-for="(src, i) in imagePreviews" :key="i">
                                <img :src="src" class="w-20 h-20 rounded-lg object-cover border">
                            </template>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end gap-3 mt-4">
                        <button type="button" @click="showEditForm = false"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                            Cancel
                        </button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            Update Product
                        </button>
                    </div>
                </form>
            </div>
        </div>



    </div>
@endsection
