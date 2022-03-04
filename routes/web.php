<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\App\Product\ProductController;
use App\Http\Controllers\App\Order\OrderController;
use App\Http\Controllers\App\Customer\CustemerController;
use App\Http\Controllers\App\Basket\BasketController;
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
    return redirect()->route('app.product.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::namespace('App')->group(function(){

    Route::prefix('product')->group(function (){
        Route::get('/', [ProductController::class, 'index'])->name('app.product.index');
        Route::get('/modal/{product_id}', [ProductController::class, 'modal'])->name('app.product.modal');
    });

    Route::prefix('order')->group(function (){
        Route::get('/', [OrderController::class, 'index'])->name('app.order.index');
        Route::get('/store', [OrderController::class, 'store'])->name('app.order.store');
        Route::get('/delete/{order_id}', [OrderController::class, 'destroy'])->name('app.order.destroy');
    });

    Route::prefix('custemer')->group(function (){
        Route::get('/', [CustemerController::class, 'index'])->name('app.custemer.index');
    });

    Route::prefix('basket')->group(function (){
        Route::get('/', [BasketController::class, 'index'])->name('app.basket.index');
        Route::post('/store', [BasketController::class, 'store'])->name('app.basket.store');
        Route::get('/edit/{product_id}', [BasketController::class, 'edit'])->name('app.basket.edit');
        Route::post('/update/{product_id}', [BasketController::class, 'update'])->name('app.basket.update');
        Route::get('/delete/{product_id}', [BasketController::class, 'destroy'])->name('app.basket.destroy');
    });
});
