<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    //
    public function transaction()
    {
    	return $this->belongsTo( Transaction::class );
    }

    public function product()
    {
    	return $this->hasOne( AmazonProduct::class );
    }
}
