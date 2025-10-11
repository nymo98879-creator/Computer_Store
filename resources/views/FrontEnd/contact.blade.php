@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-xl rounded-3xl p-10">
    <h1 class="text-3xl font-bold mb-8 text-gray-800 text-center">Contact Us</h1>

    <form class="space-y-6">
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Full Name</label>
            <input type="text" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">Email Address</label>
            <input type="email" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">Message</label>
            <textarea class="w-full border border-gray-300 rounded-xl px-4 py-2 h-32 focus:ring-2 focus:ring-blue-500"></textarea>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-3 rounded-xl hover:bg-blue-700">
            Send Message
        </button>
    </form>

    <div class="mt-10 text-center text-gray-600">
        <p><i class="fa-solid fa-phone mr-2"></i> +855 96 123 4567</p>
        <p><i class="fa-solid fa-envelope mr-2"></i> support@kmstore.com</p>
        <p><i class="fa-solid fa-location-dot mr-2"></i> Phnom Penh, Cambodia</p>
    </div>
</div>
@endsection
