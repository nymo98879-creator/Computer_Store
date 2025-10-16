@extends('admin.app')

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
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded-lg">
                            @else
                                <span class="text-gray-400 text-sm">No image</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="#" class="bg-yellow-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-yellow-600 transition">Edit</a>
                                <a href="#" class="bg-red-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-red-600 transition">Delete</a>
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
@endsection
