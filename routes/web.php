<?php

use App\Http\Controllers\AdminController;
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
    return view('layouts.app');
});

Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/customer', [AdminController::class, 'customer'])->name('customer');
Route::get('/product', [AdminController::class, 'product'])->name('product');
Route::post('/product', [AdminController::class, 'storeProduct'])->name('store.product');
Route::get('/product/{id}', [AdminController::class, 'showProduct'])->name('show.product');
Route::put('/product/{id}', [AdminController::class, 'updateProduct'])->name('update.product');
Route::delete('/product/{id}', [AdminController::class, 'destroyProduct'])->name('destroy.product');

// ORDERAN
Route::get('/orderan', [AdminController::class, 'orderan'])->name('orderan');

// ADMIN
Route::get('/admin', [AdminController::class, 'admin'])->name('admin');

// LAPORAN
Route::get('/laporan', [AdminController::class, 'laporan'])->name('laporan');
