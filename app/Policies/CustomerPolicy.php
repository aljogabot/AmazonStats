<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User, App\Customer;

class CustomerPolicy
{
    use HandlesAuthorization;

    public function show( User $user, Customer $customer )
    {
        return $user->owns( $customer );
    }

    public function save( User $user, Customer $customer )
    {
    	return $user->owns( $customer );
    }

    public function delete( User $user, Customer $customer )
    {
    	return $user->owns( $customer );
    }
}
