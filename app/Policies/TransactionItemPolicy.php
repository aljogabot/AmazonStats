<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User, App\TransactionItem;

class TransactionItemPolicy
{
    use HandlesAuthorization;

    public function show( User $user, TransactionItem $transactionItem )
    {
        return $user->owns( $transactionItem->transaction->customer );
    }

    public function save( User $user, TransactionItem $transactionItem )
    {
        return $user->owns( $transactionItem->transaction->customer );   
    }

    public function delete( User $user, TransactionItem $transactionItem )
    {
        return $user->owns( $transactionItem->transaction->customer );
    }
}
