<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Customer\RegistrationController;
use App\Http\Controllers\Product\ProductController;
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


Route::group(['namespace' => 'Customer'], function(){
    Route::post('customer/registration', [RegistrationController::class, 'registration'])->name('customer.registration');    
});

Route::group(['namespace' => 'Auth'], function(){
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::post('logout', [LogoutController::class, 'logout'])->middleware('auth:api')->name('logout');
});

Route::group(['namespace' => 'Product', 'prefix' => 'product', 'as' => 'product.'], function(){
    Route::post('store', [ProductController::class, 'store'])->name('store');
});