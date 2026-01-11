<?php

namespace App\Providers;

use App\Listeners\CartEmpty;
use App\Listeners\DeductProductQuantity;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    protected $listen = [
        'order_created' => [
            DeductProductQuantity::class
        ]
    ];

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
