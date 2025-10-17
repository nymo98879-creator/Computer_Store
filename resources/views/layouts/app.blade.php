<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @vite('resources/css/app.css')
    <!-- Store Building Icon -->
    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'><path fill='%23007bff' d='M20 18c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2H0v2h24v-2h-4zM4 6h16v10H4V6z'/></svg>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>

<body class="bg-gray-100">

    {{-- Navbar --}}
    <header class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-8 h-[70px]">
            <!-- Left: Logo -->
            <div class="flex items-center space-x-3">
                <i class="fa-solid fa-computer text-3xl text-blue-600"></i>
                <h1 class="text-xl lg:text-3xl font-extrabold text-gray-800">KM <span class="text-blue-600">STORE</span>
                </h1>
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
                {{-- <i
                    class="fa-solid fa-cart-shopping text-xl text-gray-700 hover:text-blue-600 transition cursor-pointer"></i> --}}
                <!-- Include Alpine.js -->
                <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

                <!-- Wrap icon + sidebar in one Alpine component -->
                <div x-data="{ openCart: false }" class="relative">
                    <div class="flex items-center space-x-6">


                        <!-- Cart Icon -->
                        <i class="fa-solid fa-cart-shopping text-xl text-gray-700 hover:text-blue-600 cursor-pointer"
                            @click="openCart = true"></i>
                    </div>

                    <!-- Sidebar Cart -->
                    <div x-show="openCart" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0"
                        x-transition:leave-end="translate-x-full"
                        class="fixed top-0 right-0 w-80 h-full bg-white shadow-lg z-50 p-5" style="display: none;">
                        <!-- Close Button -->
                        <button @click="openCart = false" class="text-gray-500 hover:text-gray-700 mb-4">
                            Close
                        </button>

                        <h2 class="text-2xl font-bold mb-4">Your Cart</h2>
                        <ul>
                            <li class="mb-2">Product 1 - $10</li>
                            <li class="mb-2">Product 2 - $15</li>
                            <li class="mb-2">Product 3 - $20</li>
                        </ul>
                        <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Checkout
                        </button>
                    </div>
                </div>

                <div> <i id="user"
                        class="fa-solid fa-user text-xl text-gray-700 hover:text-blue-600 transition cursor-pointer"></i>
                </div>
                <!-- Mobile menu toggle -->
                <button id="menuToggle" class="md:hidden text-2xl text-gray-700 hover:text-blue-600 focus:outline-none">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <nav id="mobileMenu" class="hidden bg-gray-100 md:hidden flex-col space-y-3 py-4 px-6 border-t">
            <a href="{{ route('home') }}" class="block text-lg text-gray-700 hover:text-blue-600">Home</a>
            <a href="{{ route('fproduct') }}" class="block text-lg text-gray-700 hover:text-blue-600">Product</a>
            <a href="{{ route('fcategory') }}" class="block text-lg text-gray-700 hover:text-blue-600">Category</a>
            <a href="{{ route('accessories') }}" class="block text-lg text-gray-700 hover:text-blue-600">Accessories</a>
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

    <!-- 🧾 LOGIN FORM -->
    <form action="{{ url('/admin/login') }}" method="POST" id="loginForm"
        class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2
    bg-white shadow-2xl rounded-3xl w-[400px] p-8 z-50 border border-gray-200 {{ session('error') ? '' : 'hidden' }}">
        @csrf
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Login</h2>

        @if (session('error'))
            <p class="text-red-500 text-center mb-4">{{ session('error') }}</p>
        @endif

        <div class="mb-5">
            <label class="block text-gray-700 font-semibold mb-2">Email</label>
            <input type="email" name="email"
                class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500" value="{{ old('email') }}"
                required>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Password</label>
            <input type="password" name="password"
                class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500" required>
        </div>

        <button type="submit"
            class="w-full bg-blue-600 text-white font-semibold py-2 rounded-xl hover:bg-blue-700 transition duration-200">
            Login
        </button>

        <p class="text-sm text-center mt-4">Don't have an account?
            <a href="#" id="openRegister" class="text-blue-500 hover:underline">Register</a>
        </p>
    </form>

    <!-- 🧾 REGISTER FORM -->
    <form action="{{ url('/register') }}" method="POST" id="registerForm"
        class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2
    bg-white shadow-2xl rounded-3xl w-[400px] p-8 z-50 border border-gray-200 hidden">
        @csrf
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Register</h2>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Name</label>
            <input type="text" name="name"
                class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Email</label>
            <input type="email" name="email"
                class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Password</label>
            <input type="password" name="password"
                class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Confirm Password</label>
            <input type="password" name="password_confirmation"
                class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500" required>
        </div>

        <button type="submit"
            class="w-full bg-green-600 text-white font-semibold py-2 rounded-xl hover:bg-green-700 transition duration-200">
            Register
        </button>

        <p class="text-sm text-center mt-4">Already have an account?
            <a href="#" id="openLogin" class="text-blue-500 hover:underline">Login</a>
        </p>
    </form>
    <script>
        const userIcon = document.getElementById('user');
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');
        const openRegister = document.getElementById('openRegister');
        const openLogin = document.getElementById('openLogin');

        // Show login when user icon clicked
        userIcon.addEventListener('click', (e) => {
            e.preventDefault();
            loginForm.classList.toggle('hidden');
            registerForm.classList.add('hidden');
        });

        // Toggle between login and register
        openRegister?.addEventListener('click', (e) => {
            e.preventDefault();
            loginForm.classList.add('hidden');
            registerForm.classList.remove('hidden');
        });

        openLogin?.addEventListener('click', (e) => {
            e.preventDefault();
            registerForm.classList.add('hidden');
            loginForm.classList.remove('hidden');
        });

        // Hide when clicking outside
        window.addEventListener('click', (e) => {
            if (!loginForm.contains(e.target) && !registerForm.contains(e.target) && e.target !== userIcon) {
                loginForm.classList.add('hidden');
                registerForm.classList.add('hidden');
            }
        });
    </script>

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
                    <a href="https://www.facebook.com/?_rdc=1&_rdr#" target="_blank" class="hover:text-blue-500"><i
                            class="fa-brands fa-facebook"></i></a>
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
