<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @vite('resources/css/app.css')
    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'><path fill='%23007bff' d='M20 18c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2H0v2h24v-2h-4zM4 6h16v10H4V6z'/></svg>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-100 " x-data="{}">

    {{-- Navbar --}}
    <header class="bg-white shadow-lg sticky top-0 z-50">
        <div class=" px-10 mx-auto flex justify-between items-center h-[70px]">
            {{-- Logo --}}
            <div class="flex items-center space-x-3">
                <i class="fa-solid fa-computer text-3xl text-blue-600"></i>
                <h1 class="text-xl lg:text-3xl font-extrabold text-gray-800">KM <span class="text-blue-600">STORE</span>
                </h1>
            </div>

            {{-- Navigation --}}
            <nav class="hidden md:flex flex-1 justify-center items-center space-x-8">

                {{-- 🏠 Home --}}
                <a href="{{ route('home') }}"
                    class="font-medium transition-colors duration-300
        {{ request()->routeIs('home') ? 'text-red-600 border-b-2 border-red-600 pb-1' : 'text-gray-700 hover:text-blue-600' }}">
                    Home
                </a>

                {{-- 🛍 Product --}}
                <a href="{{ route('front.product') }}"
                    class="font-medium transition-colors duration-300
        {{ request()->routeIs('front.product') ? 'text-red-600 border-b-2 border-red-600 pb-1' : 'text-gray-700 hover:text-blue-600' }}">
                    Product
                </a>

                {{-- ✅ Category Dropdown --}}
                <select id="categorySelect"
                    class="w-44 border border-gray-300 rounded-lg px-4 py-2 text-gray-700 bg-white font-medium
        focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all duration-300 shadow-sm hover:shadow-md">
                    <option value="">Select Category</option>
                    <option value="{{ route('flaptop') }}" {{ request()->routeIs('flaptop') ? 'selected' : '' }}>Laptop
                    </option>
                    <option value="{{ route('fdesktop') }}" {{ request()->routeIs('fdesktop') ? 'selected' : '' }}>
                        Desktop</option>
                    <option value="{{ route('fnetwork') }}" {{ request()->routeIs('fnetwork') ? 'selected' : '' }}>
                        Network</option>
                </select>

                <script>
                    document.getElementById('categorySelect').addEventListener('change', function() {
                        if (this.value) {
                            window.location.href = this.value;
                        }
                    });
                </script>

                {{-- 🎧 Accessories --}}
                <a href="{{ route('faccessories') }}"
                    class="font-medium transition-colors duration-300
        {{ request()->routeIs('faccessories') ? 'text-red-600 border-b-2 border-red-600 pb-1' : 'text-gray-700 hover:text-blue-600' }}">
                    Accessories
                </a>

                {{-- 🧭 About Us --}}
                <a href="{{ route('about') }}"
                    class="font-medium transition-colors duration-300
        {{ request()->routeIs('about') ? 'text-red-600 border-b-2 border-red-600 pb-1' : 'text-gray-700 hover:text-blue-600' }}">
                    About Us
                </a>

                {{-- ☎ Contact --}}
                <a href="{{ route('contact') }}"
                    class="font-medium transition-colors duration-300
        {{ request()->routeIs('contact') ? 'text-red-600 border-b-2 border-red-600 pb-1' : 'text-gray-700 hover:text-blue-600' }}">
                    Contact
                </a>
            </nav>


            {{-- Right Icons --}}
            <div class="flex items-center space-x-6">
                {{-- Search --}}

                <div class="relative ">
                    <form action="{{ route('product.search') }}" method="GET"
                        class="flex items-center bg-white border border-gray-300 rounded-full overflow-hidden shadow-sm w-60 max-w-sm">
                        <input type="text" name="search" placeholder="Search product..."
                            value="{{ request('search') }}"
                            class="flex-grow px-4 py-2 text-sm text-gray-700 focus:outline-none">
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white hover:bg-indigo-700 transition">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>



                {{-- Cart --}}
                <div x-data="{ openCart: false }" class="relative">
                    <i class="fa-solid fa-cart-shopping text-xl text-gray-700 hover:text-blue-600 cursor-pointer"
                        @click="openCart = true"></i>

                    @php $cart = session('cart', []); @endphp
                    @if (count($cart) > 0)
                        <span
                            class="absolute -top-4 right-[-50%] bg-red-500 text-white text-xs rounded-full px-1">{{ count($cart) }}</span>
                    @endif

                    {{-- Sidebar Cart --}}
                    <div x-show="openCart" x-transition
                        class="fixed top-0 right-0 w-[500px] h-full bg-white shadow-2xl z-50 p-6 overflow-y-auto rounded-l-2xl border-l border-gray-200"
                        @click.outside="openCart = false">

                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold text-gray-800">🛒 Your Cart</h2>
                            <button @click="openCart = false"
                                class="text-gray-400 hover:text-gray-600 text-lg transition">✕</button>
                        </div>

                        @if (count($cart) > 0)
                            <ul class="divide-y divide-gray-100">
                                @foreach ($cart as $id => $item)
                                    <li
                                        class="py-4 flex items-center justify-between hover:bg-gray-50 rounded-xl px-2 transition">
                                        <div class="flex items-center space-x-4">
                                            <img src="{{ asset('storage/' . $item['image']) }}"
                                                alt="{{ $item['name'] }}"
                                                class="w-14 h-14 rounded-xl object-cover shadow-sm border border-gray-100">
                                            <div>
                                                <p class="font-semibold text-gray-800">{{ $item['name'] }}</p>
                                                <p class="text-sm text-gray-500">Qty: {{ $item['quantity'] }}</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-green-600 font-semibold">
                                                ${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="keep_cart_open" value="1">
                                                <button type="submit"
                                                    class="text-xs text-red-500 hover:text-red-700 font-medium transition">Remove</button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            {{-- Checkout / Login --}}
                            <div class="mt-8 border-t border-gray-200 pt-4">

                                @if (session()->has('user_logged_in'))
                                    <form action="{{ route('order.store') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="w-full bg-green-600 text-white py-3 rounded-xl font-semibold hover:bg-green-700 transition">
                                            Proceed to Checkout
                                        </button>
                                    </form>
                                @else
                                    <button type="button"
                                        @click.stop="
                                            loginForm.classList.remove('hidden');
                                            registerForm.classList.add('hidden');
                                            openCart = false;
                                        "
                                        class="w-full bg-green-600 text-white py-3 rounded-xl font-semibold hover:bg-green-700 transition">
                                        Login to Checkout
                                    </button>
                                @endif
                            </div>
                        @else
                            <div class="text-center mt-20">
                                <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png"
                                    class="w-24 mx-auto mb-4 opacity-70" alt="Empty Cart">
                                <p class="text-gray-500 text-lg">Your cart is empty 🛍️</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- User Icon / Logout --}}
                <div class="flex items-center space-x-4">
                    @if (!session()->has('user_logged_in'))
                        <i id="user"
                            class="fa-solid fa-user text-xl text-gray-700 hover:text-blue-600 cursor-pointer"></i>
                    @else
                        <span class="text-gray-700 font-medium">{{ session('user_name') }}</span>
                        <a href="{{ route('customer.logout') }}"
                            class="text-gray-700 hover:text-red-500 transition cursor-pointer" title="Logout">
                            <i class="fa-solid fa-right-from-bracket text-xl"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </header>

    {{-- LOGIN FORM --}}

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
                class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500"
                value="{{ old('email') }}" required>
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

    {{-- REGISTER FORM --}}
    <form action="{{ url('/register') }}" method="POST" id="registerForm"
        class="hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2
    bg-white shadow-2xl rounded-3xl w-[450px] p-8 z-50 border border-gray-200">
        @csrf

        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Create an Account</h2>

        <!-- Name -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Full Name</label>
            <input type="text" name="name"
                class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                placeholder="Enter your full name" required>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Email Address</label>
            <input type="email" name="email"
                class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                placeholder="example@email.com" required>
        </div>

        <!-- Phone -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Phone Number</label>
            <input type="text" name="phone"
                class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                placeholder="+855 12 345 678" required>
        </div>

        <!-- Address -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Address</label>
            <textarea name="address" rows="2"
                class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none resize-none"
                placeholder="Enter your address" required></textarea>
        </div>

        <!-- Password -->
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Password</label>
                <input type="password" name="password"
                    class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                    placeholder="********" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Confirm</label>
                <input type="password" name="password_confirmation"
                    class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                    placeholder="********" required>
            </div>
        </div>

        <!-- Button -->
        <button type="submit"
            class="w-full bg-green-600 text-white font-semibold py-2 rounded-xl hover:bg-green-700 transition duration-200 shadow-md">
            Register
        </button>

        <p class="text-sm text-center mt-4 text-gray-600">
            Already have an account?
            <a href="#" id="openLogin" class="text-green-600 font-semibold hover:underline">Login</a>
        </p>
    </form>




    {{-- JS --}}
    <script>
        const userIcon = document.getElementById('user');
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');
        const openRegister = document.getElementById('openRegister');
        const openLogin = document.getElementById('openLogin');

        userIcon?.addEventListener('click', e => {
            e.preventDefault();
            loginForm.classList.toggle('hidden');
            registerForm.classList.add('hidden');
        });

        openRegister?.addEventListener('click', e => {
            e.preventDefault();
            loginForm.classList.add('hidden');
            registerForm.classList.remove('hidden');
        });

        openLogin?.addEventListener('click', e => {
            e.preventDefault();
            registerForm.classList.add('hidden');
            loginForm.classList.remove('hidden');
        });

        window.addEventListener('click', e => {
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
    <footer class="bg-gray-900 text-gray-300 mt-10">
        <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-3 gap-10">
            <div>
                <h2 class="text-2xl font-bold text-white mb-3">KM STORE</h2>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Your trusted computer and accessories store. High-performance devices and gaming gear.
                </p>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-white mb-3">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="hover:text-blue-400 transition">Home</a></li>
                    <li><a href="{{ route('front.product') }}" class="hover:text-blue-400 transition">Products</a>
                    </li>
                    {{-- <li><a href="{{ route('flaptop') }}" class="hover:text-blue-400 transition">Categories</a></li> --}}
                    <li><a href="{{ route('faccessories') }}" class="hover:text-blue-400 transition">Accessories</a>
                    </li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-white mb-3">Follow Us</h3>
                <div class="flex space-x-5 text-2xl">
                    <a href="https://web.facebook.com/" target="_blank" class="hover:text-blue-500"><i
                            class="fa-brands fa-facebook"></i></a>
                    <a href="https://web.facebook.com/" target="_blank" class="hover:text-pink-500"><i
                            class="fa-brands fa-instagram"></i></a>
                    <a href="https://web.facebook.com/" target="_blank" class="hover:text-sky-400"><i
                            class="fa-brands fa-twitter"></i></a>
                    <a href="https://web.facebook.com/" target="_blank" class="hover:text-red-500"><i
                            class="fa-brands fa-youtube"></i></a>
                </div>
                <p class="text-gray-400 text-sm mt-6">© 2025 KM Store. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>

</html>
