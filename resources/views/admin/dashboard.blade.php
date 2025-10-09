@extends('admin.app')

@section('title', 'Dashboard')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen ">
    <!-- Header -->
    <h1 class="text-3xl font-bold text-gray-800 mb-6">KM Computer Store Dashboard</h1>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-2">
        <div class="bg-white shadow-lg rounded-2xl p-6 border-t-4 border-blue-500">
            <h2 class="text-gray-500 text-sm font-medium">Total Products</h2>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalProducts ?? 0 }}</p>
        </div>
        <div class="bg-white shadow-lg rounded-2xl p-6 border-t-4 border-indigo-500">
            <h2 class="text-gray-500 text-sm font-medium">Total Categories</h2>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalCategories ?? 0 }}</p>
        </div>
        <div class="bg-white shadow-lg rounded-2xl p-6 border-t-4 border-green-500">
            <h2 class="text-gray-500 text-sm font-medium">Total Orders</h2>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalOrders ?? 0 }}</p>
        </div>
        <div class="bg-white shadow-lg rounded-2xl p-6 border-t-4 border-yellow-500">
            <h2 class="text-gray-500 text-sm font-medium">Total Customers</h2>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalCustomers ?? 0 }}</p>
        </div>
    </div>

    <!-- Sales Chart -->
    <div class="bg-white shadow-lg rounded-2xl p-6 mb-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Monthly Sales Overview</h2>
        <canvas id="salesChart" height="100"></canvas>
    </div>

    <!-- Low Stock Products -->
    {{-- <div class="bg-white grid grid-cols-1 shadow-lg rounded-2xl p-6 ">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Low Stock Products</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left border-collapse">
                <thead class="bg-gradient-to-r from-red-500 to-red-600 text-white uppercase text-sm font-semibold">
                    <tr>
                        <th class="px-6 py-3">Image</th>
                        <th class="px-6 py-3">Product Name</th>
                        <th class="px-6 py-3">Stock</th>
                        <th class="px-6 py-3">Price</th>
                        <th class="px-6 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($lowStockProducts ?? [] as $product)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-3">
                                <img src="{{ $product->image }}" class="w-14 h-14 rounded-lg object-cover" alt="">
                            </td>
                            <td class="px-6 py-3">{{ $product->name }}</td>
                            <td class="px-6 py-3 text-red-600 font-bold">{{ $product->stock }}</td>
                            <td class="px-6 py-3 text-green-600 font-semibold">${{ $product->price }}</td>
                            <td class="px-6 py-3 text-center">
                                <a href="{{ route('product.edit', $product->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg shadow">Edit</a>
                                <a href="{{ route('product.delete', $product->id) }}" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg shadow ml-2">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> --}}


    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Monthly Sales ($)',
                data: [500, 800, 1200, 1500, 1800, 2400, 2000],
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true } }
        }
    });
    </script>
</div>

@endsection
