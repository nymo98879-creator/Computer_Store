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
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-[2000px] mx-auto px-6  flex justify-between items-center h-[70px]">

            {{-- LOGO --}}
            <div class="flex items-center space-x-3">
                <i class="fa-solid fa-computer text-4xl text-indigo-600"></i>
                <h1 class="text-2xl font-extrabold text-gray-900">
                    KM <span class="text-indigo-600">STORE</span>
                </h1>
            </div>

            {{-- NAVIGATION --}}
            <nav class="hidden lg:flex items-center space-x-10 font-medium text-gray-700">
                <a href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'text-indigo-600 border-b-2 border-indigo-600 pb-1' : 'hover:text-indigo-600' }}">
                    Home
                </a>

                <a href="{{ route('front.product') }}"
                    class="{{ request()->routeIs('front.product') ? 'text-indigo-600 border-b-2 border-indigo-600 pb-1' : 'hover:text-indigo-600' }}">
                    Product
                </a>

                {{-- Category Dropdown --}}
                <div x-data="{ openCategory: false }" class="relative">
                    <!-- Category Button -->
                    <button @click="openCategory = !openCategory"
                        class="flex items-center justify-between w-44 px-5 py-2.5 text-gray-700 bg-gray-50 border border-gray-200
               rounded-full   hover:border-indigo-400 focus:ring-2 focus:ring-indigo-200
               transition-all duration-300 font-medium">
                        <span>
                            <i class="fa-solid fa-layer-group mr-2 text-indigo-400"></i>
                            Category
                        </span>
                        <i class="fa-solid fa-chevron-down ml-1 text-gray-400 text-sm transition-transform duration-300"
                            :class="{ 'rotate-180 text-indigo-500': openCategory }"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="openCategory" x-transition @click.outside="openCategory = false"
                        class="absolute left-0 mt-3 w-52  border border-gray-200 rounded-2xl shadow-lg
               backdrop-blur-md bg-white/80 py-2 z-50">

                        <a href="{{ route('flaptop') }}"
                            class="flex items-center px-5 py-2.5 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition rounded-lg">
                            <i class="fa-solid fa-laptop mr-2 text-indigo-400"></i> Laptop
                        </a>

                        <a href="{{ route('fdesktop') }}"
                            class="flex items-center px-5 py-2.5 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition rounded-lg">
                            <i class="fa-solid fa-desktop mr-2 text-indigo-400"></i> Desktop
                        </a>

                        <a href="{{ route('fnetwork') }}"
                            class="flex items-center px-5 py-2.5 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition rounded-lg">
                            <i class="fa-solid fa-network-wired mr-2 text-indigo-400"></i> Network
                        </a>

                        <a href="{{ route('faccessories') }}"
                            class="flex items-center px-5 py-2.5 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition rounded-lg">
                            <i class="fa-solid fa-headphones mr-2 text-indigo-400"></i> Accessories
                        </a>
                    </div>
                </div>


                <a href="{{ route('about') }}"
                    class="{{ request()->routeIs('about') ? 'text-indigo-600 border-b-2 border-indigo-600 pb-1' : 'hover:text-indigo-600' }}">
                    About
                </a>

                {{-- <a href="{{ route('contact') }}"
                    class="{{ request()->routeIs('contact') ? 'text-indigo-600 border-b-2 border-indigo-600 pb-1' : 'hover:text-indigo-600' }}">
                    Contact
                </a> --}}
            </nav>

            {{-- RIGHT SIDE: Search, Filter, Cart, User --}}
            <div class="flex items-center space-x-6">



                {{-- PRICE FILTER --}}
                <form action="{{ route('product.search') }}" method="GET"
                    class="flex flex-1 items-center bg-gray-50 border border-gray-300 rounded-full shadow-sm overflow-hidden p-1 space-x-2">

                    <input type="text" name="search" placeholder="Search product..."
                        value="{{ request('search') }}"
                        class="flex-grow px-4 py-2 text-gray-700 text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">

                    <select name="category"
                        class="px-3 py-2 text-gray-700 text-sm rounded-full border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition">
                        <option value="">All Categories</option>
                        <option value="laptop" {{ request('category') == 'laptop' ? 'selected' : '' }}>Laptop</option>
                        <option value="desktop" {{ request('category') == 'desktop' ? 'selected' : '' }}>Desktop
                        </option>
                        <option value="network" {{ request('category') == 'network' ? 'selected' : '' }}>Network
                        </option>
                        <option value="accessories" {{ request('category') == 'accessories' ? 'selected' : '' }}>
                            Accessories</option>
                    </select>
                    {{--
                    <input type="number" name="min_price" placeholder="Min $" value="{{ request('min_price') }} "
                        min="0" step="10"
                        class="w-20 px-3 py-2 text-gray-700 text-sm rounded-full border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition"> --}}
                    <input type="number" name="min_price" placeholder="Min $" value="{{ request('min_price') }}"
                        min="0" step="10"
                        class="w-20 px-3 py-2 text-gray-700 text-sm rounded-full border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition">

                    <span class="text-gray-500">to</span>

                    <input type="number" name="max_price" placeholder="Max $" value="{{ request('max_price') }}"
                        min="0" step="10"
                        class="w-20 px-3 py-2 text-gray-700 text-sm rounded-full border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition">

                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-full shadow-md hover:bg-indigo-700 transition">
                        Filter
                    </button>
                </form>


                {{-- CART --}}
                <div x-data="{ openCart: false }" class="relative">
                    <i class="fa-solid fa-cart-shopping text-xl text-gray-700 hover:text-indigo-600 cursor-pointer"
                        @click="openCart = true"></i>

                    @php $cart = session('cart', []); @endphp
                    @if (count($cart) > 0)
                        <span class="absolute -top-2 -right-3 bg-red-500 text-white text-xs rounded-full px-1">
                            {{ count($cart) }}
                        </span>
                    @endif

                    {{-- Cart Sidebar --}}
                    <div x-show="openCart" x-transition
                        class="fixed top-0 right-0 w-[450px] h-full bg-white shadow-2xl z-50 p-6 overflow-y-auto border-l border-gray-200"
                        @click.outside="openCart = false">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold text-gray-800">Your Cart</h2>
                            <button @click="openCart = false"
                                class="text-gray-500 hover:text-gray-700 text-xl">✕</button>
                        </div>
                        {{-- Cart Items --}}
                        @if (count($cart) > 0)
                            <ul class="divide-y divide-gray-100">
                                @foreach ($cart as $id => $item)
                                    <li class="py-4 flex justify-between items-center">
                                        <div class="flex items-center space-x-4">
                                            <img src="{{ asset('storage/' . $item['image']) }}" alt=""
                                                class="w-14 h-14 rounded-xl object-cover shadow">
                                            <div>
                                                <p class="font-semibold text-gray-800">{{ $item['name'] }}</p>
                                                <p class="text-sm text-gray-500">Qty: {{ $item['quantity'] }}</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-green-600 font-semibold">
                                                ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                            </p>
                                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="text-xs text-red-500 hover:text-red-700 transition">
                                                    Remove
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="mt-6 border-t border-gray-200 pt-4">
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
                                        class="w-full bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">
                                        Login to Checkout
                                    </button>
                                @endif
                            </div>
                        @else
                            <div class="text-center mt-20">
                                <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png"
                                    class="w-24 mx-auto mb-4 opacity-70" alt="">
                                <p class="text-gray-500 text-lg">Your cart is empty 🛍️</p>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- ✅ Order Success Popup -->
                @if (session('order_success'))
                    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                        {{-- auto hide after 5s --}}
                        class="fixed inset-0 flex items-center justify-center bg-black/50 z-[9999] w-full">
                        <div class="bg-white rounded-2xl shadow-2xl p-8 text-center max-w-sm w-full sm:w-full transform transition-all duration-300"
                            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
                            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-90">
                            <i class="fa-solid fa-circle-check text-green-500 text-6xl mb-4 animate-bounce"></i>
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">Order Successful!</h2>
                            <p class="text-gray-600">{{ session('order_success') }}</p>

                            <button @click="show = false"
                                class="mt-5 bg-indigo-600 text-white px-6 py-2 rounded-full font-medium hover:bg-indigo-700 transition">
                                Continue Shopping
                            </button>
                        </div>
                    </div>
                @endif


                {{-- USER ICON --}}
                <div class="flex items-center space-x-3">
                    @if (!session()->has('user_logged_in'))
                        <i id="user"
                            class="fa-solid fa-user text-xl text-gray-700 hover:text-indigo-600 cursor-pointer"></i>
                    @else
                        <span class="text-gray-700 font-medium">{{ session('user_name') }}</span>
                        <a href="{{ route('customer.logout') }}" class="text-gray-700 hover:text-red-500 transition"
                            title="Logout">
                            <i class="fa-solid fa-right-from-bracket text-2xl"></i>
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
