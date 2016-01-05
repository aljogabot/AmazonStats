<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    protected $fillable = [ 'amazon_product_id', 'quantity', 'payout' ];

    public function transaction()
    {
    	return $this->belongsTo( Transaction::class );
    }

    public function amazonProduct()
    {
    	return $this->belongsTo( AmazonProduct::class );
    }
}
