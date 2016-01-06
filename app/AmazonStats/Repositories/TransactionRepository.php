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
					->select( 'transactions.*', 'customers.first_name AS customer_first_name', 'customers.last_name AS customer_last_name' )
					->join( 'customers', 'customers.id', '=', 'transactions.customer_id' )
					->join( 'users', 'users.id', '=', 'customers.user_id' );

		if( ! empty( $search ) )
		{
			$model = $model->orWhere(
				function( $query ) use( $search )
				{
					$query->orWhere( 'amazon_order_id', 'LIKE', "%{$search}%" )
							->orWhere( 'recipient_email', 'LIKE', "%{$search}%" )
							->orWhere( 'recipient_name', 'LIKE', "%{$search}%" );
				}
			);
		}

		return $model->where( 'users.id', '=', \Auth::id() )->paginate( 10 );
	}

	public function getAllTransactionItems()
	{
		return $this->model->items()
					->select( 'customers.name AS customer_name', 'transaction_items.*', 'amazon_products.name AS amazon_product_name', 'transactions.amazon_order_id AS transaction_amazon_id' )
					->join( 'amazon_products', 'amazon_products.id', '=', 'transaction_items.amazon_product_id' )
					->join( 'transactions', 'transactions.id', '=', 'transaction_items.transaction_id' )
					->join( 'customers', 'customers.id', '=', 'transactions.customer_id' )
					->join( 'users', 'users.id', '=', 'customers.user_id' )
					->paginate( 10 );
	}
}