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

    //Category
    // Route::get('admin/category/laptop', function () {
    //     return view('admin.category.laptop');
    // })->name('admin/laptop');
    // Route::get('admin/category/desktop', function () {
    //     return view('admin.category.desktop');
    // });
    // Route::get('admin/category/monitor', function () {
    //     return view('admin.category.monitor');
    // });
    // Route::get('admin/category/accessories', function () {
    //     return view('admin.category.accessories');
    // });
});




Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');




Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
//Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/dashboard', [DashboardController::class, 'counts'])->name('admin.dashboard');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Product
    Route::get('/dproduct', [DProductController::class, 'index'])->name('admin.products.index');
    Route::post('/dproduct', [DProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [DProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [DProductController::class, 'update'])->name('products.update');
    Route::delete('/dproduct/{id}', [DProductController::class, 'destroy'])->name('admin.dproduct.destroy');

    //Category
    // Route::get('dcategory/laptop', [DCategoyLaptopController::class, 'index'])->name('admin.laptop.index');
    // Route::put('/admin/dcategory-laptop/update/{id}', [DCategoyLaptopController::class, 'update'])->name('admin.dcategorylaptop.update');
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
