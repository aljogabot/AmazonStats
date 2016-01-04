<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\User, App\AmazonProduct;

class ProductPolicy
{
    use HandlesAuthorization;

    public function show( User $user, AmazonProduct $customer )
    {
        return $user->owns( $customer );
    }

    public function save( User $user, AmazonProduct $customer )
    {
        return $user->owns( $customer );
    }

    public function delete( User $user, AmazonProduct $customer )
    {
        return $user->owns( $customer );
    }
}
