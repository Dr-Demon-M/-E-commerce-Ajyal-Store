<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\front\CheckoutController;
use App\Http\Controllers\Front\CurrencyConverterController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwoFactorController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    // Home page
    Route::get('/', [HomeController::class, 'index'])->name('home');
    require __DIR__ . '/dashboard.php';

    // Product
    Route::get('/products/{category:slug}', [ProductController::class, 'index'])->name('allProducts.index');
    Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('allProduct.show');


    // Cart 
    Route::resource('cart', CartController::class);


    // Checkout
    Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout');
    Route::post('checkout', [CheckoutController::class, 'store']);


    //Profile
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });


    // 2FA 
    Route::get('/Two-Factor-Auth', [TwoFactorController::class, 'index'])->name('2fa');


    // Currency
    Route::post('converter', [CurrencyConverterController::class, 'store'])->name('converter.store');


    // Currency
    Route::post('converter', [CurrencyConverterController::class, 'store'])->name('converter.store');


    // order 
    Route::resource('user/orders', OrderController::class)->names('user-orders');

    require __DIR__ . '/auth.php';
    require __DIR__ . '/UserAuth.php';
});
