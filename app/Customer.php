<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [ 'email', 'first_name', 'last_name', 'name', 'emailed', 'buyer_id' ];

    public function first_name()
    {
        if( ! empty( $this->first_name ) )
            return $this->first_name;

        if( ! empty( $this->name ) )
        {
            $name = explode( ' ', $this->name );
            array_pop( $name );

            return implode( ' ', $name );
        }

        return NULL;
    }

    public function last_name()
    {
        if( ! empty( $this->last_name ) )
            return $this->last_name;

        if( ! empty( $this->name ) )
        {
            $name = explode( ' ', $this->name );
            return array_pop( $name );
        }

        return NULL;
    }

    public function setName()
    {
        $this->name = $this->first_name . ' ' . $this->last_name;
    }

    public function user()
    {
    	return $this->belongsTo( User::class );
    }

    public function transactions()
    {
    	return $this->hasMany( Transaction::class );
    }

    public function transactionsCount()
    {
        return $this->hasOne( Transaction::class )
                    ->selectRaw( 'customer_id, count(*) as aggregate' )
                    ->groupBy( 'customer_id' );
    }

    public function getTransactionsCountAttribute()
    {
        // if relation is not loaded already, let's do it first
        if ( ! array_key_exists('transactionsCount', $this->relations)) 
            $this->load('transactionsCount');

        $related = $this->getRelation('transactionsCount');

        // then return the count directly
        return ($related) ? (int) $related->aggregate : 0;
    }
}
