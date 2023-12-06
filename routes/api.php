<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\RajaongkirController;

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

Route::post('/shopping-cart/update', [UserController::class, 'updateCartPrice'])->name('cart.updateprice');

Route::get('/shopping-cart/get/{cart_id}', [UserController::class, 'updateCartPrice2'])->name('cart.updateprice2');

Route::post('/shopping-cart/checkout/update-address', [UserController::class, 'checkoutUpdateAddress'])->name('checkout.updateaddress');

Route::post('/shopping-cart/checkout/courier', [UserController::class, 'checkoutGetCourier'])->name('user.checkout.getcourier');

Route::get('/rajaongkir/province', [RajaongkirController::class, 'getProvince'])->name('api.rajaongkir.getprovince');

Route::post('/rajaongkir/city', [RajaongkirController::class, 'getCity'])->name('api.rajaongkir.getcity');

Route::post('/rajaongkir/fee', [RajaongkirController::class, 'getFee'])->name('api.rajaongkir.getfee');
