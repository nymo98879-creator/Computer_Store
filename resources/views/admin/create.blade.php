 @extends('admin.app')

 @section('title', 'Products')

 @section('content')
     @vite(['resources/js/admin/product.js'])
     <div class="p-6 bg-gray-100 min-h-screen" x-data="{ showForm: false }"></div>

     <div x-show="showForm" x-transition.opacity
         class="fixed inset-0 bg-gray-500/50 bg-opacity-60 flex items-center justify-center z-50" x-cloak>
         <!-- Modal Box -->
         <div @click.away="showForm = false" x-transition.scale
             class="bg-white rounded-2xl shadow-2xl w-[90%] md:w-[500px] p-6 relative">
             <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Add New Product</h2>

             <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">


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
                     <label class="block text-gray-600 mb-1">Category</label>
                     <select name="category_id"
                         class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                         >
                         {{-- <option value="">-- Select Category --</option>
                         @foreach ($categories as $category)
                             <option value="{{ $category->id }}">{{ $category->name }}</option>
                         @endforeach --}}
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
                         <a href="{{ url('product') }}">Cancel</a>
                     </button>
                     <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                         Save
                     </button>
                 </div>
             </form>
         </div>
     </div>

     </div>
     <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
 @endsection
