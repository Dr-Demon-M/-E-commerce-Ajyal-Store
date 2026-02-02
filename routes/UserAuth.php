<?php

use App\Http\Controllers\Auth\UserAuth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\UserAuth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\UserAuth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\UserAuth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\UserAuth\NewPasswordController;
use App\Http\Controllers\Auth\UserAuth\PasswordController;
use App\Http\Controllers\Auth\UserAuth\PasswordResetLinkController;
use App\Http\Controllers\Auth\UserAuth\RegisteredUserController;
use App\Http\Controllers\Auth\UserAuth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:web')->group(function () {
    Route::get('user/register', [RegisteredUserController::class, 'create'])
        ->name('user.register');

    Route::post('user/register', [RegisteredUserController::class, 'store']);

    Route::get('user/login', [AuthenticatedSessionController::class, 'create'])
        ->name('user.login');

    Route::post('user/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('user/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('user.password.request');

    Route::post('user/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('user.password.email');

    Route::get('user/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('user.password.reset');

    Route::post('user/reset-password', [NewPasswordController::class, 'store'])
        ->name('user.password.store');
});

Route::get('user/verify-email', [EmailVerificationPromptController::class, '__invoke'])
    ->name('user.verification.notice');

Route::get('user/verify-email/{id}/{hash}', [VerifyEmailController::class, 'verify'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('user.verification.verify');

Route::post('user/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('user.verification.send');

Route::middleware('auth:web')->group(function () {

    Route::get('user/confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('user.password.confirm');

    Route::post('user/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('user/password', [PasswordController::class, 'update'])->name('user.password.update');

    Route::post('user/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('user.logout');
});
