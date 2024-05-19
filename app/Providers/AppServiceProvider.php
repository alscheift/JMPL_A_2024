<?php

namespace App\Providers;

use App\Http\Middleware\AdminOnly;
use App\Http\Middleware\UserOwnPost;
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
            // use middleware to check if user is admin
            return AdminOnly::is_admin();
        });

        Gate::define('userownpost', function ($user, $post) {
            return UserOwnPost::is_my_post($user, $post);
        });

        // Custom Blade Directive
        Blade::if('admin', function () {
            return request()->user()?->can('admin');
        });
    }
}
