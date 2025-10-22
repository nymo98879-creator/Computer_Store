@extends('admin.app')

@section('title', 'Orders')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Orders (Total: {{ $count }})</h1>

    <div class="bg-white shadow-lg rounded-2xl p-6">
        <table class="w-full text-sm text-left border-collapse">
            <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
                <tr>
                    <th class="px-6 py-3">Order ID</th>
                    <th class="px-6 py-3">Customer</th>
                    <th class="px-6 py-3">Total</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($orders as $order)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-3">{{ $order->id }}</td>
                    <td class="px-6 py-3">{{ $order->customer->name ?? 'N/A' }}</td>
                    <td class="px-6 py-3 text-green-600 font-semibold">${{ number_format($order->total_price, 2) }}</td>
                    <td class="px-6 py-3">
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-semibold">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="px-6 py-3">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
