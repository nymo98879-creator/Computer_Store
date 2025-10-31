@extends('layouts.app')

@section('content')
<section class="bg-gray-50 py-20">
    <div class="container mx-auto px-6">

        <!-- Hero / Intro -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h1 class="text-5xl font-bold text-gray-800 mb-4">Welcome to TechShop</h1>
            <p class="text-gray-600 text-lg">Your one-stop shop for laptops, desktops, networking equipment, and computer accessories. We provide high-quality products at affordable prices with excellent customer support.</p>
        </div>

        <!-- Our Mission & Vision -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-16">
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
                <h2 class="text-2xl font-semibold mb-4 text-blue-600">Our Mission</h2>
                <p class="text-gray-600">We aim to provide our customers with the latest technology products, expert advice, and reliable service to make every purchase easy and satisfying.</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
                <h2 class="text-2xl font-semibold mb-4 text-blue-600">Our Vision</h2>
                <p class="text-gray-600">To become a trusted technology partner for our customers and create a seamless shopping experience for computer enthusiasts and professionals alike.</p>
            </div>
        </div>

        <!-- Why Choose Us / Features -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Why Choose Us</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition text-center">
                    <h3 class="text-xl font-semibold mb-2 text-blue-600">High Quality</h3>
                    <p class="text-gray-500">We carefully select only trusted brands and components.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition text-center">
                    <h3 class="text-xl font-semibold mb-2 text-blue-600">Affordable Prices</h3>
                    <p class="text-gray-500">Get the best deals without compromising quality.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition text-center">
                    <h3 class="text-xl font-semibold mb-2 text-blue-600">Fast Delivery</h3>
                    <p class="text-gray-500">We deliver your products quickly and safely.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition text-center">
                    <h3 class="text-xl font-semibold mb-2 text-blue-600">Support Team</h3>
                    <p class="text-gray-500">Our team is always ready to assist you with your needs.</p>
                </div>
            </div>
        </div>

        <!-- Optional Team Section -->
        <div class="text-center mb-16 ">
            <h2 class="text-3xl font-bold text-gray-800 mb-10">Meet Our Team</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-8 px-52">
                <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition">

                    <img src="{{ asset('image/image.png') }}"  alt="Team Member" class="w-32 h-32 mx-auto  object-cover rounded-full bg-blue-500 mb-4">
                    <h3 class="text-xl font-semibold text-gray-800 mb-1">MO NY</h3>
                    <p class="text-gray-500">CEO / Founder</p>
                </div>
                <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition">
                    <img src="image/image1.png" alt="Team Member" class="w-32 h-32 mx-auto rounded-full bg-red-500 mb-4 flex justify-center items-center">
                    <h3 class="text-xl font-semibold text-gray-800 mb-1">Choekhim</h3>
                    <p class="text-gray-500">Marketing Manager</p>
                </div>

            </div>
        </div>

        <!-- Contact / CTA -->
        <div class="bg-blue-600 rounded-2xl p-12 text-center text-white">
            <h2 class="text-3xl font-bold mb-4">Have Questions?</h2>
            <p class="mb-6">Contact us today and our team will help you find the perfect products for your needs.</p>
            <a href="" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">Contact Us</a>
        </div>

    </div>
</section>
@endsection
