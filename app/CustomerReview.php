<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerReview extends Model
{
    protected $fillable = [ 'link', 'notes' ];

    public function customer()
    {
    	return $this->belongsTo( Customer::class );
    }

    public function product()
    {
    	return $this->belongsTo( AmazonProduct::class );
    }
}
