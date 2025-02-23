<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'loginPage']);
    Route::post('/login', [AuthController::class, 'loginCheck'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/customer', [AdminController::class, 'customer'])->name('customer');
    Route::delete('/customer/{id}', [AdminController::class, 'deleteCustomer'])->name('delete.customer');
    Route::get('/product', [AdminController::class, 'product'])->name('product');
    Route::post('/product', [AdminController::class, 'storeProduct'])->name('store.product');
    Route::get('/product/{id}', [AdminController::class, 'showProduct'])->name('show.product');
    Route::put('/product/{id}', [AdminController::class, 'updateProduct'])->name('update.product');
    Route::delete('/product/{id}', [AdminController::class, 'destroyProduct'])->name('destroy.product');

    // ORDERAN
    Route::get('/orderan', [AdminController::class, 'orderan'])->name('orderan');
    Route::get('/orderan/{id}', [AdminController::class, 'orderanDetails'])->name('orderan.details');
    Route::post('/orderan/{id}', [AdminController::class, 'orderanUpdate'])->name('orderan.update');

    // PENGATURAN
    Route::get('/pengaturan', [AdminController::class, 'pengaturan'])->name('pengaturan');
    Route::post('/pengaturan', [AdminController::class, 'pengaturanSave'])->name('pengaturan-save');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
