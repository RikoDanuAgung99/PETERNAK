<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();

        Gate::define('isAdmin', fn($user) => $user->level === 'ADMIN');
        Gate::define('isPeternak', fn($user) => $user->level === 'PETERNAK');
        Gate::define('isTS', fn($user) => $user->level === 'TS');
        Gate::define('isPeternakOrAdmin', function ($user) {
            return $user->level === 'PETERNAK' || $user->level === 'ADMIN';
        });
        Gate::define('isTSOrAdmin', function ($user) {
            return $user->level === 'TS' || $user->level === 'ADMIN';
        });
        Gate::define('isPeternakOrTS', function ($user) {
            return $user->level === 'PETERNAK' || $user->level === 'TS';
        });
        Gate::define('isPeternakOrTSOrAdmin', function ($user) {
            return $user->level === 'PETERNAK' || $user->level === 'TS' || $user->level === 'ADMIN';
        });
    }
}
