@extends('admin.app')

@section('title', 'Categories')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Categories</h1>
        <a href=""
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow">
           Add New Category
        </a>
    </div>

    <!-- Categories Table -->
    <div class="bg-white shadow-lg rounded-2xl p-6 overflow-x-auto">
        <table class="w-full text-sm text-left border-collapse">
            <thead class="bg-gray-200 text-gray-700 uppercase text-sm font-semibold">
                <tr>
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Category Name</th>
                    <th class="px-6 py-3">Description</th>
                    <th class="px-6 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($categories ?? [] as $category)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-3 font-medium text-gray-700"></td>
                        <td class="px-6 py-3"></td>
                        <td class="px-6 py-3"></td>
                        <td class="px-6 py-3 text-center flex justify-center gap-2">
                            <a href=""
                               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg shadow">
                               Edit
                            </a>
                            <form action="" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg shadow"
                                        onclick="return confirm('Are you sure you want to delete this category?')">
                                        Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
