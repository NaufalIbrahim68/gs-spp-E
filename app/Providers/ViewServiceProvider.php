<?php

namespace App\Providers;

use App\View\Composers\CartComposer;
use App\View\Composers\CategoryComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        View::composer('*', CategoryComposer::class);
        View::composer('layouts.front.header', CartComposer::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {}
}
