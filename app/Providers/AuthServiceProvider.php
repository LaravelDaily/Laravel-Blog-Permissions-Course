<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('publish-articles', function ($user) {
            return $user->is_admin || $user->is_publisher;
        });

        Gate::define('manage-categories', function ($user) {
            return $user->is_admin;
        });

        Gate::define('see-article-user', function ($user) {
            return $user->is_admin;
        });
    }
}
