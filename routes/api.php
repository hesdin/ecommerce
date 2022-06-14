<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth', [AuthController::class, 'userLogin']);
Route::post('/register', [AuthController::class, 'userRegister']);

Route::group(['middleware' => 'auth:user'], function() {
    Route::get('/user', function(Request $req) {
        return response()->json([
            'user' => $req->user()
        ], 200);
    });
    Route::get('/products', [UserController::class, 'products']);

    // cart
    Route::get('/cart', [UserController::class, 'cart']);
    Route::get('/count-cart', [UserController::class, 'countCart']);
    Route::post('/cart', [UserController::class, 'addToCart']);
    Route::post('/cart/increase', [UserController::class, 'increaseQty']);
    Route::post('/cart/decrease', [UserController::class, 'decreaseQty']);
    Route::delete('/cart', [UserController::class, 'deleteCartItem']);
    Route::post('/checkout', [UserController::class, 'checkout']);;

    Route::get('/orderan', [UserController::class, 'orderan']);
    Route::put('/orderan/cancel', [UserController::class, 'orderanCancel']);

    Route::get('/favorites', [UserController::class, 'favorites']);
    Route::post('/favorite', [UserController::class, 'favoriteAction']);
});
