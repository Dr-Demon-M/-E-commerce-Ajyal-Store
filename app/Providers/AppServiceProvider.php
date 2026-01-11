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
        Gate::define('dashboard.view', function ($user) {
            return true;
        });
        Gate::define('categories.view', function ($user) {
            return true;
        });
        Gate::define('categories.edit', function ($user) {
            return true;
        });
        Gate::define('categories.create', function ($user) {
            return true;
        });
        Gate::define('categories.delete', function ($user) {
            return false;
        });
        Gate::define('products.view', function ($user) {
            return true;
        });
        Gate::define('stores.view', function ($user) {
            return true;
        });

        Paginator::useBootstrapFive(); // to use paginate Style
        // View::share('key', 'value'); to share data for all views
    }
}
