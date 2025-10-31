@extends('admin.app')

@section('title', 'Network Products')

@section('content')
<div class="p-8 bg-gray-100 min-h-screen" x-data="{
    showEditForm: false,
    editProduct: {}
}">
    {{-- 🌐 Network Header --}}
    <h1 class="text-3xl font-bold mb-6 text-gray-800">
        Products in Category: {{ $category->name }}
    </h1>

    {{-- 📦 Products Table --}}
    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <table class="min-w-full border-collapse">
            <thead class="bg-gray-200 text-gray-700 uppercase text-sm sticky top-0">
                <tr>
                    <th class="py-3 px-4 text-left">#</th>
                    <th class="py-3 px-4 text-left">Product Name</th>
                    <th class="py-3 px-4 text-left">Price</th>
                    <th class="py-3 px-4 text-left">Stock</th>
                    <th class="py-3 px-4 text-left">Images</th>
                    {{-- <th class="py-3 px-4 text-center">Actions</th> --}}
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($category->products as $key => $product)
                <tr class="hover:bg-gray-50 transition">
                    <td class="py-3 px-4">{{ $key + 1 }}</td>
                    <td class="py-3 px-4 font-medium text-gray-800">{{ $product->name }}</td>
                    <td class="py-3 px-4 font-semibold text-green-600">${{ number_format($product->price, 2) }}</td>
                    <td class="py-3 px-4">{{ $product->stock }}</td>

                    {{-- Images --}}
                    <td class="py-3 px-4 flex gap-2">
                        @forelse($product->images as $img)
                            <img src="{{ asset('storage/' . $img->image) }}" class="w-16 h-16 object-cover rounded-lg">
                        @empty
                            <span class="text-gray-400 text-sm">No image</span>
                        @endforelse
                    </td>

                    {{-- Actions --}}
                    <td class="py-3 px-4 text-center">
                        <div class="flex justify-center space-x-2">
                            {{-- Edit button opens modal --}}
                            {{-- <button
                                @click="
                                    showEditForm = true;
                                    editProduct = {
                                        id: {{ $product->id }},
                                        name: '{{ addslashes($product->name) }}',
                                        description: '{{ addslashes($product->description) }}',
                                        price: {{ $product->price }},
                                        stock: {{ $product->stock }},
                                        category_id: {{ $product->category_id }},
                                        images: [
                                            @foreach($product->images as $img)
                                                {id: {{ $img->id }}, image: '{{ asset('storage/' . $img->image) }}'}@if(!$loop->last),@endif
                                            @endforeach
                                        ]
                                    };
                                "
                                class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600 transition">
                                Edit
                            </button> --}}

                            {{-- Delete form --}}
                            {{-- <form action="{{ route('admin.network.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </form> --}}
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

    {{-- ✅ Edit Product Modal --}}
    <div x-show="showEditForm" x-transition.opacity class="fixed inset-0 bg-gray-500/50 flex items-center justify-center z-50" x-cloak>
        <div @click.away="showEditForm = false" x-transition.scale
             class="bg-white rounded-2xl shadow-2xl w-[90%] md:w-[500px] p-6"
             x-data="{ newImages: [], imagePreviews: [] }">

            <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Edit Network Product</h2>

            <form :action="`/admin/network/${editProduct.id}`" method="POST" enctype="multipart/form-data" class="space-y-3">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div>
                    <label class="block text-gray-600 mb-1">Name</label>
                    <input type="text" name="name" x-model="editProduct.name"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" required>
                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-gray-600 mb-1">Description</label>
                    <textarea name="description" rows="3" x-model="editProduct.description"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                {{-- Price & Stock --}}
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-gray-600 mb-1">Price ($)</label>
                        <input type="number" name="price" x-model="editProduct.price" step="0.01"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Stock</label>
                        <input type="number" name="stock" x-model="editProduct.stock"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>

                {{-- Existing Images --}}
                <div>
                    <label class="block text-gray-600 mb-1">Existing Images</label>
                    <div class="flex gap-2 flex-wrap">
                        <template x-for="(img,index) in editProduct.images" :key="img.id">
                            <div class="relative">
                                <img :src="img.image" class="w-20 h-20 object-cover rounded-lg border">
                                <button type="button" @click="editProduct.images.splice(index,1)"
                                        class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">×
                                </button>
                                <input type="hidden" name="existing_images[]" :value="img.id">
                            </div>
                        </template>
                    </div>
                </div>

                {{-- Add New Images --}}
                <div>
                    <label class="block text-gray-600 mb-1 mt-2">Add New Images</label>
                    <input type="file" name="images[]" multiple accept="image/*"
                           @change="
                                imagePreviews = [];
                                newImages = [];
                                for(const f of $event.target.files){
                                    newImages.push(f);
                                    imagePreviews.push(URL.createObjectURL(f));
                                }
                            "
                           class="w-full border border-gray-300 rounded-lg px-3 py-2"
                    >
                    <div class="flex gap-2 flex-wrap mt-2">
                        <template x-for="(src,i) in imagePreviews" :key="i">
                            <img :src="src" class="w-20 h-20 object-cover rounded-lg border">
                        </template>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex justify-end gap-3 mt-4">
                    <button type="button" @click="showEditForm=false"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">Cancel</button>
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Update Product</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
