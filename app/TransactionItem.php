<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    protected $fillable = [ 'amazon_order_item_id', 'amazon_product_id', 'quantity', 'payout', 'item_promotion_discount' ];

    public function transaction()
    {
    	return $this->belongsTo( Transaction::class );
    }

    public function amazonProduct()
    {
    	return $this->belongsTo( AmazonProduct::class );
    }
}