<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    protected $fillable = [ 'amazon_order_id', 'recipient_name', 'recipient_email' ];

    //
    public function customer()
    {
    	return $this->belongsTo( Customer::class );
    }

    public function items()
    {
    	return $this->hasMany( TransactionItem::class );
    }

    public function transactionItemsCount()
    {
        return $this->hasOne( TransactionItem::class )
                    ->selectRaw( 'transaction_id, count(*) as aggregate' )
                    ->groupBy( 'transaction_id' );
    }

    public function getTransactionItemsCountAttribute()
    {
        // if relation is not loaded already, let's do it first
        if ( ! array_key_exists('transactionItemsCount', $this->relations)) 
            $this->load('transactionItemsCount');

        $related = $this->getRelation('transactionItemsCount');

        // then return the count directly
        return ($related) ? (int) $related->aggregate : 0;
    }
}
