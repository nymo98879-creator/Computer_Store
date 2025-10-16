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
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $products ?? 0}}</p>
            </div>
            <div class="bg-white shadow-lg rounded-2xl p-6 border-t-4 border-indigo-500">
                <h2 class="text-gray-500 text-sm font-medium">Total Categories</h2>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $categories ?? 0 }}</p>
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
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>

@endsection
