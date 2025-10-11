<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
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

    Route::get('/product', function () {
        return view('admin.dproduct');
    })->name('dproduct');

    Route::get('/dcategory', function () {
        return view('admin.dcategory');
    })->name('dcategory');

    Route::get('/order', function () {
        return view('admin.order');
    })->name('order');

    Route::get('/customer', function () {
        return view('admin.customer');
    })->name('customer');
});


// Route::get('/admin/login', [AdminController::class, 'showLoginForm']);
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');

// Protect everything under admin/
Route::middleware(['admin.auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
});
