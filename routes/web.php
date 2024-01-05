<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/products');

Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index')->name('products');
    Route::get('/products/{product}', 'checkout')->name('products.checkout');
    Route::post('/products/{product}/apply-voucher', 'applyVoucher')->name('products.apply-voucher');
    Route::get('/products/{product}/buy', 'buy')->name('products.buy');
});

Route::controller(TransactionController::class)->group(function () {
    Route::get('/transactions', 'index')->name('transactions');
    Route::get('/transactions/{transaction}', 'show')->name('transactions.show');
});
