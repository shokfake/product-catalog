<?php

namespace App\Policies;

use App\User;
use App\Product;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Collection;

class ProductPolicy
{
    const MANAGERS = 'managers';
    use HandlesAuthorization;

/*
     * @param \App\User $user
     * @param Product $product
     * @return mixed
     */
    public function managers(User $user, int $categoryId)
    {
        /** @var Collection $categories */
        $categories = $user->categories->pluck('name', 'id');
        return $categories->has($categoryId) || $user->hasRole(User::SUPER_USER);

    }

}
