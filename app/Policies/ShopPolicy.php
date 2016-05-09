<?php

namespace App\Policies;

use App\Shop;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShopPolicy
{
    use HandlesAuthorization;

    protected $policies = [
        Shop::class => ShopPolicy::class,
    ];
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function before($user, $ability)
    {

    }

    /**
     * @param User $user
     * @param Shop $shop
     * @return bool
     */
    public function update(User $user, Shop $shop)
    {
        return $user->id == $shop->user_id;
    }
}
