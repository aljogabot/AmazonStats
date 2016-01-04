<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User, App\Customer, App\Transaction;

class TransactionsPolicy
{
    use HandlesAuthorization;

    public function show( User $user, Transaction $transaction )
    {
        return $user->hasCustomer( $transaction->customer );
    }

    public function save( User $user, Transaction $transaction )
    {
    	return $user->hasCustomer( $transaction->customer );	
    }

	public function delete( User $user, Transaction $transaction )
    {
        return $user->hasCustomer( $transaction->customer );
    }    
}
