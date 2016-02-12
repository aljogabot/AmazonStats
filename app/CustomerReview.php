<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerReview extends Model
{
    protected $fillable = [ 'link', 'notes', 'amazon_product_id', 'customer_id' ];

    public function customer()
    {
    	return $this->belongsTo( Customer::class );
    }

    public function product()
    {
    	return $this->belongsTo( AmazonProduct::class, 'amazon_product_id' );
    }

}