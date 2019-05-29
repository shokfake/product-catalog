<?php

namespace App\Providers;

use App\User;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

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
     * @param Gate $gate
     * @return void
     */
    public function boot(Gate $gate): void
    {
//        $this->registerPolicies();

        $gate->define('action-with-product', function (User $user, int $categoryId){
            /** @var Collection $categories */
            $categories = $user->categories->pluck('name', 'id');
            return ($categories->has($categoryId) && $user->hasRole(User::ADMIN_MANAGERS) )|| $user->hasRole(User::SUPER_USER);
        });

        Passport::routes();

    }
}
