<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
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
        // Gate Facade
        Gate::define('admin', function ($user) {
            return $user->username === 'afif';
        });

        // Custom Blade Directive
        Blade::if('admin', function () {
            return request()->user()?->can('admin');
        });
    }
}
