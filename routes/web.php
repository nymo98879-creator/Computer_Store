<?php

use App\Http\Controllers\NetworkController;
use Illuminate\Support\Facades\Route;

// 🧭 Controllers
use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DCategoryAccessoriesController;
use App\Http\Controllers\Admin\DProductController;

use App\Http\Controllers\Admin\DCategoyDesktopController;
use App\Http\Controllers\Admin\DCategoyLaptopController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FAccessoriesController;
use App\Http\Controllers\Admin\FCategoryController;
use App\Http\Controllers\Admin\FProductController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DesktopController;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductDetailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| These are the routes for both Frontend and Admin (Backend).
|--------------------------------------------------------------------------
*/

/* ============================
| 🌐 FRONTEND ROUTES
|============================= */

//Home page
Route::get('/', [HomeController::class, 'index'])->name('home');
//Product page
Route::get('/fproduct', [FProductController::class, 'indexfront'])->name('front.product');
Route::get('/search', [FProductController::class, 'search'])->name('product.search');
//Category page
// Route::get('/fcategories', [FCategoryController::class, 'indexfront'])->name('fcategory');
Route::get('/accessories', [FAccessoriesController::class, 'indexfront'])->name('faccessories');
//Details product
Route::get('/product/{id}', [ProductDetailController::class, 'show'])->name('product.show');
//Cart add
Route::post('/product/{id}/cart', [CartController::class, 'add'])->name('product.cart');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
//Order Product
Route::post('/check_out', [OrderController::class, 'store'])->name('order.store');

// desktop
Route::get('/laptop', [LaptopController::class, 'index'])->name('flaptop');
route::get('desktop/categories', [DesktopController::class, 'index'])->name('fdesktop');

Route::get('/network', [NetworkController::class, 'index'])->name('fnetwork');

Route::get('/product/{id}', [DProductController::class, 'show'])
    ->name('product.show');

// Network page

Route::get('/about', function () {
    return view('FrontEnd.about');
})->name('about');

Route::get('/contact', function () {
    return view('FrontEnd.contact');
})->name('contact');

/* ============================
| 🔐 AUTHENTICATION ROUTES
|============================= */

// Admin Login and Register
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/register', [AdminController::class, 'register'])->name('register.submit');
Route::get('/customer/logout', [AdminController::class, 'logoutCustomer'])->name('customer.logout');


/* ============================
| 🧰 ADMIN ROUTES (Protected)
|============================= */

Route::middleware(['admin.auth'])->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'count'])->name('admin.dashboard');

    // Logout
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Products (CRUD)
    Route::get('/dproduct', [DProductController::class, 'index'])->name('admin.products.index');
    // Route::get('/dproduct', [DProductController::class, 'indexpiganate'])->name('admin.products.paginate');

    // Route::get('/dproduct', [DProductController::class, 'indexfront'])->name('front.products.index');
    Route::post('/dproduct', [DProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [DProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [DProductController::class, 'update'])->name('products.update');
    Route::delete('/dproduct/{id}', [DProductController::class, 'destroy'])->name('admin.dproduct.destroy');

    // Count
    Route::get('/count', [DashboardController::class, 'count'])->name('admin.product.count');

    // Category: Laptop
    Route::get('/dcategory-laptop', [DCategoyLaptopController::class, 'index'])->name('admin.laptop.index');
    Route::put('/dcategory-laptop/update/{id}', [DCategoyLaptopController::class, 'update'])->name('admin.dcategorylaptop.update');

    // Category: Desktop
    Route::get('/dcategory/desktop', [DCategoyDesktopController::class, 'index'])->name('admin.desktop.index');
    Route::put('/dcategory-desktop/update/{id}', [DCategoyDesktopController::class, 'update'])->name('admin.dcategorydesktop.update');

    // Category: Accessories
    Route::get('/dcategory/accessories', [DCategoryAccessoriesController::class, 'index'])->name('admin.accessories.index');
    Route::put('/dcategory-accessories/update/{id}', [DCategoryAccessoriesController::class, 'update'])->name('admin.dcategoryaccessories.update');

    // Customer Management
    Route::get('/customer', [CustomerController::class, 'index'])->name('admin.customer');

    //Order
    Route::get('/order_count', [OrderController::class, 'index'])->name('order.count');
});


/* ============================
| 👤 USER ROUTES (Protected)
|============================= */

Route::middleware(['customerAuth'])->group(function () {
    Route::get('/customer/home', [AdminController::class, 'customerHome'])->name('customer.home');
});
