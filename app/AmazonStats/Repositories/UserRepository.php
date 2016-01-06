<?php

namespace AmazonStats\Repositories;

use App\User, App\Customer;

class UserRepository extends EloquentRepository {

	public function __construct( User $user )
	{
		$this->model = $user;
	}

	public function register( $userData )
	{
		$userData[ 'name' ] = $userData[ 'first_name' ] . ' ' . $userData[ 'last_name' ];
		return $this->model->create( $userData );
	}

	public function getAllCustomers( $search = '' )
	{
		if( ! $this->model->id )
			$this->model = \Auth::user();

		$search = trim( $search );

		if( ! empty( $search ) )
		{
			return $this->model->customers()->where( 'first_name', 'LIKE', "%{$search}%" )
									->orWhere( 'last_name', 'LIKE', "%{$search}%" )
									->orWhere( 'name', 'LIKE', "%{$search}%" )
									->orWhere( 'email', 'LIKE', "%{$search}%" )
									->paginate( 10 );
		}

		return $this->model->customers()->paginate( 10 );
	}

	public function owns( $model )
	{
		return $this->model->id == $model->user_id;
	}

	public function getAllTransactions()
	{
		return $this->model->with( 'customers.transactions' )
					->where( 'id', '=', \Auth::id() )
					->paginate( 10 );
	}

	public function getAllProducts( $search = '' )
	{
		if( ! $this->model->id )
			$this->model = \Auth::user();
		
		$search = trim( $search );

		if( ! empty( $search ) )
		{
			return $this->model->products()
						->where( 'name', 'LIKE', "%{$search}%" )
						->orWhere( 'sku', 'LIKE', "%{$search}%" )
						->paginate( 10 );
		}

		return $this->model->products()->paginate( 10 );
	}

}