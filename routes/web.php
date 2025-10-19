<?php

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/fproduct', [FProductController::class, 'indexfront'])->name('front.product');
Route::get('/fcategories', [FCategoryController::class, 'indexfront'])->name('fcategory');
Route::get('/accessories', [FAccessoriesController::class, 'indexfront'])->name('faccessories');
Route::get('/product/{id}', [ProductDetailController::class, 'show'])->name('product.show');


/* ============================
| 🔐 AUTHENTICATION ROUTES
|============================= */

// Admin Login and Register
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/register', [AdminController::class, 'register'])->name('register.submit');


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
    Route::get('/dproduct', [DProductController::class, 'indexpiganate'])->name('admin.products.index');

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




});

//Test View Page
Route::middleware(['admin.auth'])->group(function () {

    Route::get('/order', function () {
        return view('admin.order');
    })->name('order');

    Route::get('/banner', function () {
        return view('admin.banner');
    })->name('banner');
});


/* ============================
| 👤 USER ROUTES (Protected)
|============================= */

Route::middleware(['customerAuth'])->group(function () {
    Route::get('/customer/home', [AdminController::class, 'customerHome'])->name('customer.home');
});
