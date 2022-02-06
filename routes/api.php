<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Customer\RegistrationController;
use App\Http\Controllers\Order\OrderActionController;
use App\Http\Controllers\Order\OrderApprovedController;
use App\Http\Controllers\Order\OrderDeliveryController;
use App\Http\Controllers\Order\OrderHistoryController;
use App\Http\Controllers\Order\OrderRejectedController;
use App\Http\Controllers\Order\OrderSearchController;
use App\Http\Controllers\Order\OrderStoreController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ProductShowController;
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
    Route:: post('store', [ProductController::class, 'store'])->name('store');
    Route:: get('{product}/show', [ProductController::class, 'show'])->name('show');
    Route:: post('{product}/update', [ProductController::class, 'update'])->name('update');
    Route:: get('{product}/delete', [ProductController::class, 'delete'])->name('delete');

    Route::get('index', [ProductShowController::class, 'index'])->name('index');
    Route::get('search/{product_name}', [ProductShowController::class, 'search'])->name('search');
    Route::get('sorting/highest-to-lowest', [ProductShowController::class, 'highestToLowest'])->name('sort.highest_to_lowest');
    Route::get('sorting/lowest-to-highest', [ProductShowController::class, 'lowestToHighest'])->name('sort.lowest_to_highest');
});


Route::group(['namespace' => 'Order', 'prefix' => 'order', 'middleware' => 'auth:api', 'as' => 'order.'], function(){
    Route:: post('store', [OrderStoreController::class, 'store'])->name('store');
    Route:: post('approved', [OrderApprovedController::class, 'approved'])->name('approved');
    Route:: post('rejected', [OrderRejectedController::class, 'rejected'])->name('rejected');
    Route:: post('delivery', [OrderDeliveryController::class, 'delivery'])->name('delivery');
    Route:: post('history', [OrderHistoryController::class, 'history'])->name('history');
    Route:: post('search', [OrderSearchController::class, 'search'])->name('search');
    
});