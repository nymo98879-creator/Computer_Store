<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>

<body class="bg-gray-100">
    {{-- Navbar --}}
    {{-- <div class="h-[60px] w-full bg-gray-300 shadow-xl flex"> --}}
        {{-- Navbar --}}
        <header class="bg-white shadow-lg sticky top-0 z-50">
            <div class="max-w-7xl mx-auto flex justify-between items-center px-8 h-[70px]">
                <!-- Left: Logo -->
                <div class="flex items-center space-x-3">
                    <i class="fa-solid fa-computer text-3xl text-blue-600"></i>
                    <h1 class="text-3xl font-extrabold text-gray-800">KM <span class="text-blue-600">STORE</span></h1>
                </div>

                <!-- Center: Navigation -->
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}"
                        class="text-lg font-medium text-gray-700 hover:text-blue-600 transition">Home</a>
                    <a href="{{ route('fproduct') }}"
                        class="text-lg font-medium text-gray-700 hover:text-blue-600 transition">Product</a>
                    <a href="{{ route('fcategory') }}"
                        class="text-lg font-medium text-gray-700 hover:text-blue-600 transition">Category</a>
                    <a href="{{ route('accessories') }}"
                        class="text-lg font-medium text-gray-700 hover:text-blue-600 transition">Accessories</a>
                    <a href="{{ route('contact') }}"
                        class="text-lg font-medium text-gray-700 hover:text-blue-600 transition">Contact</a>
                </nav>

                <!-- Right: Search & Icons -->
                <div class="flex items-center space-x-6">
                    <div class="relative hidden md:block">
                        <input type="text" placeholder="Search..."
                            class="border rounded-full pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-gray-500"></i>
                    </div>
                    <i
                        class="fa-solid fa-cart-shopping text-xl text-gray-700 hover:text-blue-600 transition cursor-pointer"></i>
                    <i id="user"
                        class="fa-solid fa-user text-xl text-gray-700 hover:text-blue-600 transition cursor-pointer"></i>

                    <!-- Mobile menu toggle -->
                    <button id="menuToggle"
                        class="md:hidden text-2xl text-gray-700 hover:text-blue-600 focus:outline-none">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <nav id="mobileMenu" class="hidden bg-gray-100 md:hidden flex-col space-y-3 py-4 px-6 border-t">
                <a href="{{ route('home') }}" class="block text-lg text-gray-700 hover:text-blue-600">Home</a>
                <a href="{{ route('fproduct') }}" class="block text-lg text-gray-700 hover:text-blue-600">Product</a>
                <a href="{{ route('fcategory') }}" class="block text-lg text-gray-700 hover:text-blue-600">Category</a>
                <a href="{{ route('accessories') }}"
                    class="block text-lg text-gray-700 hover:text-blue-600">Accessories</a>
                <a href="{{ route('contact') }}" class="block text-lg text-gray-700 hover:text-blue-600">Contact</a>
            </nav>

            <script>
                const menuToggle = document.getElementById('menuToggle');
                const mobileMenu = document.getElementById('mobileMenu');

                menuToggle.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            </script>
        </header>

        <form action="{{ url('/admin/login') }}" method="POST" id="loginForm"
            class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2
    bg-white shadow-2xl rounded-3xl w-[400px] p-8 z-50 border border-gray-200
    {{ session('error') ? '' : 'hidden' }}">
            @csrf
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Admin Login</h2>

            @if (session('error'))
                <p class="text-red-500 text-center mb-4">{{ session('error') }}</p>
            @endif

            <div class="mb-5">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-2 rounded-xl hover:bg-blue-700 transition duration-200">
                Login
            </button>

            <p class="text-sm text-gray-500 text-center mt-4">Only for Admin Access</p>
        </form>
    </div>

    <script>
        const userIcon = document.getElementById('user');
        const loginForm = document.getElementById('loginForm');

        // ✅ Show / Hide form on icon click
        userIcon.addEventListener('click', (e) => {
            e.stopPropagation(); // prevent the click from triggering window listener
            e.preventDefault();
            loginForm.classList.toggle('hidden');
        });

        // ✅ Hide form when clicking outside
        window.addEventListener('click', (e) => {
            if (!loginForm.contains(e.target) && e.target !== userIcon) {
                loginForm.classList.add('hidden');
            }
        });
    </script>



    </div>

    {{-- Page Content --}}
    <div class="p-10">
        @yield('content')
    </div>

    {{-- Footer --}}
    {{-- Footer --}}
    <footer class="bg-gray-900 text-gray-300 mt-10">
        <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-3 gap-10">
            <!-- Column 1: About -->
            <div>
                <h2 class="text-2xl font-bold text-white mb-3">KM STORE</h2>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Your trusted computer and accessories store. We offer high-performance devices, gaming gear,
                    and all the tools you need to upgrade your setup.
                </p>
            </div>

            <!-- Column 2: Quick Links -->
            <div>
                <h3 class="text-xl font-semibold text-white mb-3">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="hover:text-blue-400 transition">Home</a></li>
                    <li><a href="{{ route('fproduct') }}" class="hover:text-blue-400 transition">Products</a></li>
                    <li><a href="{{ route('fcategory') }}" class="hover:text-blue-400 transition">Categories</a></li>
                    <li><a href="{{ route('accessories') }}" class="hover:text-blue-400 transition">Accessories</a>
                    </li>
                    <li><a href="{{ route('contact') }}" class="hover:text-blue-400 transition">Contact</a></li>
                </ul>
            </div>

            <!-- Column 3: Social Media -->
            <div>
                <h3 class="text-xl font-semibold text-white mb-3">Follow Us</h3>
                <div class="flex space-x-5 text-2xl">
                    <a href="#" class="hover:text-blue-500"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="hover:text-pink-500"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="hover:text-sky-400"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#" class="hover:text-red-500"><i class="fa-brands fa-youtube"></i></a>
                </div>
                <p class="text-gray-400 text-sm mt-6">© 2025 KM Store. All rights reserved.</p>
            </div>
        </div>
    </footer>


</body>

</html>
