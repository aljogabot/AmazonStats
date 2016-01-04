<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AmazonProduct extends Model
{
    protected $fillable = [ 'sku', 'name', 'price' ];

	/**
	 * A Product Belongs To A User
	 * @return Eloquent Relation ...
	 */
    public function user()
    {
    	return $this->belongsTo( User::class );
    }

    /**
     * A Product Has Many Transactions
     * @return Eloquent Relation ...
     */
    public function transaction()
    {
    	return $this->hasMany( Transaction::class );
    }
}
