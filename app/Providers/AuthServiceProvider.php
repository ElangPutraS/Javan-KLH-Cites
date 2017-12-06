<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('access-admin', function (User $user) {
            return $user->hasRole('Administrator');
        });

        Gate::define('access-pelaku-usaha', function (User $user) {
            return $user->hasRole('Pelaku Usaha');
        });

        Gate::define('access-super-admin', function (User $user) {
            return $user->hasRole('Super Admin');
        });
    }
}
