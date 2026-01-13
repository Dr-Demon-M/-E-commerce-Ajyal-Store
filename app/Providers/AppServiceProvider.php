<?php

namespace App\Providers;

use App\Repositories\CartRepository;
use App\Repositories\CartRepositoryInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            CartRepositoryInterface::class, // الاسم اللي هستدعيه بيه 
            CartRepository::class // الريبو اللي بستدعيه
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gate::before(function ($user, $ability) {
        //     if ($user->super_admin) {
        //         return true; // Super Admin has all abilities
        //     }
        // });

        // foreach (config('abilities') as $code => $label) {
        //     Gate::define($code, function ($user) use ($code) {
        //         return $user->hasAbilities($code); // hasAbilities from HasRole trait in concerns
        //     });
        // }
        Paginator::useBootstrapFive(); // to use paginate Style
        // View::share('key', 'value'); to share data for all views
    }
}
