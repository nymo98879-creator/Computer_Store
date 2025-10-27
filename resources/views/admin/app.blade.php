@vite('resources/css/app.css')
{{-- <a href="{{ url('/admin/logout') }}">Logout</a> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <title>@yield('title')</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
 <link rel="icon"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'><path fill='%23007bff' d='M20 18c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2H0v2h24v-2h-4zM4 6h16v10H4V6z'/></svg>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.0/dist/cdn.min.js" defer></script>

</head>

<body class="bg-gray-100 font-sans flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white rounded-r-3xl shadow-xl fixed h-full p-6 flex flex-col transition-transform duration-300"
        id="sidebar">
        <div class="text-center mb-8">
            {{-- <h1 class="text-2xl font-bold text-gray-800">Admin Panel</h1> --}}
            <a href="{{ route('admin.dashboard') }}" class="text-3xl font-bold text-gray-800">

                <span class="">Dashboard</span>
            </a>
        </div>
        <nav class="flex-1">
            <ul class="space-y-3">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-blue-500 hover:text-white transition">
                        <i class="fas fa-tachometer-alt w-5"></i>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    {{-- <a href="{{ route('dproduct') }}" --}}
                    <a href="{{ route('admin.products.index') }}"
                        class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-blue-500 hover:text-white transition">
                        <i class="fas fa-box w-5"></i>
                        <span class="ml-3">Products</span>
                    </a>
                </li>
                <!-- Sidebar Categories Menu -->
                <li x-data="dropdownCategory()" class="relative">
                    <!-- Main Category Button -->
                    <div
                        class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-blue-500 hover:text-white transition">
                        {{-- <a href="{{ route('admin.dcategory.index') }}"> --}}
                        {{-- <a href="{{ route('admin.dcategory.index') }}"> --}}
                            <i class="fas fa-tags w-5"></i>
                            <span class="ml-3 flex-1 text-left">Categories</span>
                        {{-- </a> --}}
                        <button @click="toggle()" type="button">
                            <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="mr-8 mt-2 w-4"></i>
                        </button>
                    </div>

                    <!-- Dropdown Sub-items -->
                    <ul x-show="open" x-transition class="mt-2 pl-8 space-y-1 text-gray-700">
                        <li>
                            {{-- <a href="{{ url('admin/category/laptop') }}" --}}
                            <a href="{{ route('admin.laptop.index') }}"
                                class="block px-4 py-2 rounded-lg hover:bg-blue-500 hover:text-white transition">
                                Laptops
                            </a>
                        </li>
                        <li>
                            <a href="{{  route('admin.desktop.index') }}"
                                class="block px-4 py-2 rounded-lg hover:bg-blue-500 hover:text-white transition">
                                Desktops
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.accessories.index')}}"
                                class="block px-4 py-2 rounded-lg hover:bg-blue-500 hover:text-white transition">
                                Accessories
                            </a>
                        </li>
                    </ul>
                </li>

                <script>
                    function dropdownCategory() {
                        return {
                            open: localStorage.getItem('categoryOpen') === 'true',
                            toggle() {
                                this.open = !this.open;
                                localStorage.setItem('categoryOpen', this.open);
                            }
                        }
                    }
                </script>


                <li>
                    <a href="{{ route('order.count') }}"
                        class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-blue-500 hover:text-white transition">
                        <i class="fas fa-shopping-cart w-5"></i>
                        <span class="ml-3">Orders</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.customer') }}"
                        class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-blue-500 hover:text-white transition">
                        <i class="fas fa-users w-5"></i>
                        <span class="ml-3">Customers</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('banner') }}"
                        class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-blue-500 hover:text-white transition">
                        <i class="fa-solid fa-scroll"></i>
                        <span class="ml-3">Banner</span>
                    </a>
                </li> --}}
                <li class="mt-6">
                    <a href="{{ url('/admin/logout') }}"
                        class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-red-500 hover:text-white transition">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span class="ml-3">Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>


    <div class="flex-1 ml-60 flex flex-col pl-5 pr-1 ">

        @yield('content')
    </div>



</body>

</html>
