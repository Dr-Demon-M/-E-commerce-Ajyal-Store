<?php

use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\front\CheckoutController;
use App\Http\Controllers\Front\CurrencyConverterController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwoFactorController;
use App\Models\Cart;
use App\Models\Payment;
use App\Repositories\CartRepository;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    // Home page
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Product
    Route::get('/products/all', [ProductController::class, 'allProduct'])->name('allProducts');
    Route::get('/products/{category:slug}', [ProductController::class, 'index'])->name('allProducts.index');
    Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('allProduct.show');


    // Cart 
    Route::resource('cart', CartController::class);
    Route::get('/checkout/success', [CartController::class, 'checkoutSuccess'])->name('checkout.success');



    // Checkout
    Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout')->middleware('verified.custom');
    Route::post('checkout', [CheckoutController::class, 'store'])->name('checkout.store')->middleware('verified.custom');


    // Coupon
    Route::post('/checkout/apply-coupon',[CheckoutController::class, 'applyCoupon'])->name('checkout.apply-coupon');


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


    // orders 
    Route::resource('user/orders', OrderController::class)->names('user.orders');
    Route::post('/user/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('user.orders.cancel');


    // About us 
    Route::view('/about-us', 'Front.about-us')->name('about-us');


    // Social Auth
    Route::get('/auth/redirect/{provider}', [SocialAuthController::class, 'redirect'])->name('social.redirect');
    Route::get('/auth/callback/{provider}', [SocialAuthController::class, 'callback'])->name('social.callback');



    require __DIR__ . '/auth.php';
    require __DIR__ . '/UserAuth.php';
});

require __DIR__ . '/dashboard.php';

// // Stripe Embedded Checkout (UI)
// Route::get('/payment/stripe', [PaymentController::class, 'stripePage'])
//     ->name('stripe.page');
// // Create Embedded Checkout Session (JSON only)
// Route::post('/payment/stripe/session', [PaymentController::class, 'createStripeSession'])
//     ->name('stripe.session');

// Stripe Redirect Checkout
Route::get('/checkout/payment', [PaymentController::class, 'createStripeSession'])->name('stripe.checkout');

// Stripe Webhook for Payment Status Updates
Route::Post('stripe/webhook', [PaymentController::class, 'handleStripeWebhook'])->name('stripe.webhook');
