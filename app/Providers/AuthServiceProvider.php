<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('isAdmin', fn($user) => $user->level === 'ADMIN');
        Gate::define('isPeternak', fn($user) => $user->level === 'PETERNAK');
        Gate::define('isTS', fn($user) => $user->level === 'TS');
        Gate::define('isAdminOrPeternak', function ($user) {
            return $user->level === 'ADMIN' || $user->level === 'PETERNAK';
        });
        Gate::define('isAdminOrTS', function ($user) {
            return $user->level === 'ADMIN' || $user->level === 'TS';
        });
        Gate::define('isPeternakOrTS', function ($user) {
            return $user->level === 'PETERNAK' || $user->level === 'TS';
        });
        Gate::define('isAdminOrPeternakOrTS', function ($user) {
            return $user->level === 'ADMIN' || $user->level === 'PETERNAK' || $user->level === 'TS' ;
        });
    }
}
