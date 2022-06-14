<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Access\Response;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Create gate for adding user
        Gate::define('add-user', function(User $user) {
            return $user->role ? Response::allow() : Response::deny('You must be an administrator');
        });

        // Create gate for deleting user
        Gate::define('delete-user', function(User $user) {
            return $user->role ? Response::allow() : Response::deny('You must be an administrator');
        });
    }
}
