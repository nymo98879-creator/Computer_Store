@extends('admin.app')

@section('title', 'Customers')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Customers</h1>

    <div class="bg-white shadow-lg rounded-2xl p-6">
        <table class="w-full text-sm text-left border-collapse">
            <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
                <tr>
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Joined</th>
                    <th class="px-6 py-3 text-center">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-3">1</td>
                    <td class="px-6 py-3">John Doe</td>
                    <td class="px-6 py-3">john@example.com</td>
                    <td class="px-6 py-3">2025-09-21</td>
                    <td class="px-6 py-3 text-center">
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-semibold">
                            Active
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
