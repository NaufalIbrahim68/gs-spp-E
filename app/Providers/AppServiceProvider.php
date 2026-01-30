<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share pending orders count with all admin views for sidebar badge
        view()->composer('layouts.admin.side', function ($view) {
            $view->with('pendingOrders', \App\Models\Order::where('status', 1)->count());
        });
    }
}
