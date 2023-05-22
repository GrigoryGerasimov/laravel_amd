<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

final class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot(): void
    {
        Gate::define('create', function(User $user) {
            return $user->hasRole('amd-creator');
        });

        Gate::define('manage', function(User $user) {
            return $user->hasRole('amd-manager');
        });
    }
}
