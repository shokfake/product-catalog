<?php

namespace App\Providers;

use App\Policies\ProductPolicy;
use App\Product;
use App\User;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
//        Product::class => ProductPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @param \Illuminate\Contracts\Auth\Access\Gate $gate
     * @return void
     */
    public function boot(Gate $gate)
    {
        $this->registerPolicies();

        $gate->define('create-product', function (User $user) {
        return ! $user->hasRole('User');
        });

        $gate->define('update-product', function (User $user, Product $product) {
            $categories = $user->categories->pluck('name','id');

            return ($user->hasRole('Admin managers') && $categories->has($product->category->id)) || $user->hasRole('Super Admin');
        });

        $gate->define('delete-product', function (User $user) {
           return $user->hasRole('Super Admin');
        });

    }
}
