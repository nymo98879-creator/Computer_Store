<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Admin;
// use App\Http\Controllers\Admin\ProductController;
// use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\DProductController;


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

//Back

Route::middleware(['admin.auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Route::get('/product', function () {
    //     return view('admin.dproduct');
    // })->name('dproduct');

    Route::get('/dcategory', function () {
        return view('admin.dcategory');
    })->name('dcategory');

    Route::get('/order', function () {
        return view('admin.order');
    })->name('order');

    Route::get('/customer', function () {
        return view('admin.customer');
    })->name('customer');
    Route::get('/banner', function () {
        return view('admin.banner');
    })->name('banner');
    Route::get('/create', function () {
        return view('admin.create');
    });
});




Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');


Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

//
    Route::get('admin/dproduct', [DProductController::class, 'index'])->name('admin.products.index');
    // Route::get('admin/dproduct/create', [DProductController::class, 'create'])->name('admin.products.create');
    Route::post('admin/dproduct', [DProductController::class, 'store'])->name('admin.products.store');
});



