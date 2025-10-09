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
    <div class="h-[70px] w-full bg-gray-300 shadow-xl flex">
        <div class="w-[20%] h-full">
            <div class="w-full h-full flex justify-center items-center">
                <h1 class="text-3xl font-bold">KM STORE</h1>
            </div>
        </div>

        <div class="w-[45%] h-full">
            <nav class="h-full">
                <ul class="flex justify-evenly items-center w-full h-full">
                    <li><a href="{{ route('home') }}" class="text-2xl hover:text-blue-600">Home</a></li>
                    <li><a href="{{ route('product') }}" class="text-2xl hover:text-blue-600">Product</a></li>
                    <li><a href="{{ route('category') }}" class="text-2xl hover:text-blue-600">Category</a></li>
                    <li><a href="{{ route('accessories') }}" class="text-2xl hover:text-blue-600">Accessories</a></li>
                    <li><a href="{{ route('contact') }}" class="text-2xl hover:text-blue-600">Contact</a></li>
                </ul>
            </nav>
        </div>

        <div class="w-[35%] h-full">
            <div class="w-full h-full flex justify-evenly items-center">
                <div class="flex w-[50%] h-[50%] justify-center items-center">
                    <input type="text" class="border-2 border-black rounded-2xl w-full px-5 py-2"
                        placeholder="Search...">
                    <i class="fa-solid text-2xl fa-magnifying-glass ml-2"></i>
                </div>
                <i class="fa-solid text-2xl fa-bell"></i>
                <a href=""><i class="fa-solid text-2xl fa-user" id="user"></i></a>

            </div>
        </div>
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
    <footer class="w-full bg-gray-300 shadow-inner mt-5">
        <div class="max-w-7xl mx-auto py-8 px-6 flex justify-between items-center">
            <!-- Left: Logo / Brand -->
            <div>
                <h2 class="text-2xl font-bold">KM STORE</h2>
                <p class="text-gray-700 text-sm mt-2">© 2025 KM Store. All rights reserved.</p>
            </div>

            <!-- Middle: Navigation links -->
            <div>
                <ul class="flex space-x-6">
                    <li><a href="{{ route('home') }}" class="hover:text-blue-600 text-lg">Home</a></li>
                    <li><a href="{{ route('product') }}" class="hover:text-blue-600 text-lg">Product</a></li>
                    <li><a href="{{ route('category') }}" class="hover:text-blue-600 text-lg">Category</a></li>
                    <li><a href="{{ route('accessories') }}" class="hover:text-blue-600 text-lg">Accessories</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-blue-600 text-lg">Contact</a></li>
                </ul>
            </div>

            <!-- Right: Social media icons -->
            <div class="flex space-x-5 text-2xl">
                <a href="#" class="hover:text-blue-600"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" class="hover:text-pink-500"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="hover:text-blue-400"><i class="fa-brands fa-twitter"></i></a>
                <a href="#" class="hover:text-red-500"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
    </footer>

</body>

</html>
