<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'first_name', 'last_name'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function customers()
    {
        return $this->hasMany( Customer::class );
    }

    public function products()
    {
        return $this->hasMany( AmazonProduct::class );
    }

    public function setFirstNameAttribute( $value )
    {
        $this->attributes[ 'first_name' ] = ucfirst( $value );
    }

    public function setLastNameAttribute( $value )
    {
        $this->attributes[ 'last_name' ] = ucfirst( $value );
    }

    public function setName()
    {
        $this->name = $this->first_name . ' ' . $this->last_name;
    }

    public function setPasswordAttribute( $value )
    {
        $this->attributes[ 'password' ] = bcrypt( $value );
    }  

    public function hasCustomer( $customer )
    {
        return $this->id == $customer->user_id;
    }
}
