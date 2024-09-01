<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\NavbarClicked;
use App\Listeners\ClearSessionOnNavbarClick;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        NavbarClicked::class => [
            ClearSessionOnNavbarClick::class,
        ],
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
