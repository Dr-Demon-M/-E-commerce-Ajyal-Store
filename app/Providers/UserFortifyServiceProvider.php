<?php

namespace App\Providers;

use App\Actions\UserFortify\CreateNewUser;
use App\Actions\UserFortify\ResetUserPassword;
use App\Actions\UserFortify\UpdateUserPassword;
use App\Actions\UserFortify\UpdateUserProfileInformation;
use App\Actions\UserFortify\UserAuthentication;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LoginResponse;

class UserFortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    // public function register(): void
    // {
    //     Config::set('fortify.guard', 'web');
    //     Config::set('fortify.passwords', 'users');
    //     Config::set('fortify.prefix', 'user');

    //     $this->app->instance(LoginResponse::class, new class implements LoginResponse {
    //         public function toResponse($request)
    //         {
    //             return redirect()->route('home');
    //         }
    //     });
    // }

    // /**
    //  * Bootstrap any application services.
    //  */
    // public function boot(): void
    // {
    //     Fortify::createUsersUsing(CreateNewUser::class);
    //     Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
    //     Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
    //     Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
    //     Fortify::authenticateUsing(function ($request) {
    //         return (new UserAuthentication())->Authentication($request);
    //     });
    //     Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);

    //     Fortify::viewPrefix('front.auth.');

    //     RateLimiter::for('login', function (Request $request) {
    //         $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

    //         return Limit::perMinute(5)->by($throttleKey);
    //     });

    //     RateLimiter::for('two-factor', function (Request $request) {
    //         return Limit::perMinute(5)->by($request->session()->get('login.id'));
    //     });
    // }
}