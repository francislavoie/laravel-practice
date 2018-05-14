<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\User;
use App\Models\Post;

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

        Passport::routes();

        // Auth gates for: User passwords
        Gate::define('change_password', function (User $user, $them) {
            return $user->isAdmin() || $them->id === $user->id;
        });

        // Auth gates for: User management
        Gate::define('user_management_access', function (User $user) {
            return $user->isAdmin();
        });

        // Auth gates for: Users
        Gate::define('user_access', function (User $user) {
            return $user->isAdmin();
        });
        Gate::define('user_create', function (User $user) {
            return $user->isAdmin();
        });
        Gate::define('user_view', function (User $user, $them) {
            return true;
            // return $user->isAdmin() || $them->id == $user->id;
        });
        Gate::define('user_edit', function (User $user, $them) {
            return $user->isAdmin() || $them->id == $user->id;
        });
        Gate::define('user_delete', function (User $user, $them) {
            return $user->isAdmin();
        });

        // Auth gates for: Address
        Gate::define('address_view', function (User $user, $address) {
            return $user->isAdmin() || $address->user_id == $user->id;
        });
        Gate::define('address_edit', function (User $user, $address) {
            return $user->isAdmin() || $address->user_id == $user->id;
        });

        // Auth gates for: Post
        Gate::define('post_access', function (User $user) {
            return true;
        });
        Gate::define('post_create', function (User $user) {
            return $user->isAdmin() || $user->isPublisher();
        });
        Gate::define('post_view', function (User $user, Post $post) {
            return $user->isAdmin() || $post->published || $post->user_id == $user->id;
        });
        Gate::define('post_edit', function (User $user, Post $post) {
            return $user->isAdmin() || ($user->isPublisher() && $post->user_id == $user->id);
        });
        Gate::define('post_delete', function (User $user, Post $post) {
            return $user->isAdmin() || ($user->isPublisher() && $post->user_id == $user->id);
        });
    }
}
