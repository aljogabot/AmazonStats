<?php

namespace AmazonStats\Repositories;

use App\Transaction;

class TransactionRepository extends EloquentRepository {

	public function __construct( Transaction $transaction )
	{
		$this->model = $transaction;
	}

	public function getAllItems()
	{
		return $this->model->items->get();
	}

	public function getAllPerUser( $search = '', $user = FALSE )
	{
		if( ! $user )
			$user = \Auth::user();

		$model = $this->model
					/*->with( [ 'customer.user' => function( $query ) use ( $user )
						{
							$query->where( 'users.id', '=', $user->id );
						}]
					);*/
					->select( 'transactions.*', 'customers.first_name AS customer_first_name', 'customers.last_name AS customer_last_name' )
					->join( 'customers', 'customers.id', '=', 'transactions.customer_id' )
					->join( 'users', 'users.id', '=', 'customers.user_id' );

		if( ! empty( $search ) )
		{
			$model = $model->orWhere(
				function( $query )
				{
					$query->where( 'amazon_order_id', 'LIKE', "%{$search}%" )
							->where( 'recipient_email', 'LIKE', "%{$search}%" )
							->where( 'recipient_name', 'LIKE', "%{$search}%" );
				}
			);
		}

		return $model->where( 'users.id', '=', \Auth::id() )->paginate( 10 );
	}
}