<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DCategoryAccessoriesController;
use App\Models\Admin;
// use App\Http\Controllers\Admin\ProductController;
// use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\DProductController;
use App\Http\Controllers\Admin\DCategoryController;
use App\Http\Controllers\Admin\DCategoyDesktopController;
use App\Http\Controllers\Admin\DCategoyLaptopController;
use App\Http\Controllers\Admin\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// use App\Http\Controllers\DProductController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Front
Route::get('/', function () {
    return view('FrontEnd.Home');
})->name('home'); // 👈 add name

Route::get('/fproduct', function () {
    return view('FrontEnd.fproduct');
})->name('fproduct'); // 👈 add name

Route::get('/fcategory', function () {
    return view('FrontEnd.fcategory');
})->name('fcategory'); // 👈 add name

Route::get('/accessories', function () {
    return view('FrontEnd.accessories');
})->name('accessories'); // 👈 add name

Route::get('/contact', function () {
    return view('FrontEnd.contact');
})->name('contact'); // 👈 add name

//Login and Redgister
Route::get('/login', function () {
    return view('FrontEnd.login');
})->name('login');
//Back

Route::middleware(['admin.auth'])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('admin.dashboard');
    // })->name('dashboard');

    Route::get('/order', function () {
        return view('admin.order');
    })->name('order');

    Route::get('/customer', function () {
        return view('admin.customer');
    })->name('customer');
    Route::get('/banner', function () {
        return view('admin.banner');
    })->name('banner');
});



//Admin Login
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
// Route::post('/login', [AdminController::class, 'login'])->name('login.submit');
Route::post('/register', [AdminController::class, 'register'])->name('register.submit');

Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    //Dashboard

        Route::get('/dashboard', [DashboardController::class, 'count'])->name('admin.dashboard');

    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Product
    Route::get('/dproduct', [DProductController::class, 'index'])->name('admin.products.index');
    Route::post('/dproduct', [DProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [DProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [DProductController::class, 'update'])->name('products.update');
    Route::delete('/dproduct/{id}', [DProductController::class, 'destroy'])->name('admin.dproduct.destroy');
    Route::get('/count', [DashboardController::class, 'count'])->name('admin.product.count');





    // Route::delete('/dproduct/count', [DProductController::class, 'count'])->name('admin.dproduct.count');



    //Category
    Route::get('/dcategory-laptop', [DCategoyLaptopController::class, 'index'])
        ->name('admin.laptop.index'); // page that shows the products

    Route::put('/dcategory-laptop/update/{id}', [DCategoyLaptopController::class, 'update'])
        ->name('admin.dcategorylaptop.update'); // update route

    Route::get('dcategory/desktop', [DCategoyDesktopController::class, 'index'])->name('admin.desktop.index');
    Route::put('/dcategory-desktop/update/{id}', [DCategoyDesktopController::class, 'update'])
        ->name('admin.dcategorydesktop.update'); // update route

    Route::get('dcategory/accessories', [DCategoryAccessoriesController::class, 'index'])->name('admin.accessories.index');
    Route::put('/dcategory-accessories/update/{id}', [DCategoryAccessoriesController::class, 'update'])
        ->name('admin.dcategoryaccessories.update'); // update route
});

//User Login
Route::middleware(['customerAuth'])->group(function () {
    Route::get('/customer/home', [AdminController::class, 'customerHome'])->name('customer.home');
});
