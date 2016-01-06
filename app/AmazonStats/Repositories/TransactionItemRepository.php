<?php

namespace AmazonStats\Repositories;

use App\TransactionItem;

class TransactionItemRepository extends EloquentRepository {

	public function __construct( TransactionItem $transactionItem )
	{
		$this->model = $transactionItem;
	}

	public function getAll()
	{
		return $this->model->paginate(10);
	}

	public function getAllPerTransaction()
	{
		
	}

	public function getAllPerUser( $search = '', $user = FALSE )
	{
		if( ! $user )
			$user = \Auth::user();

		$model = $this->model
					->select( 'customers.name AS customer_name', 'transaction_items.*', 'amazon_products.name AS amazon_product_name', 'transactions.amazon_order_id AS transaction_amazon_id' )
					->join( 'amazon_products', 'amazon_products.id', '=', 'transaction_items.amazon_product_id' )
					->join( 'transactions', 'transactions.id', '=', 'transaction_items.transaction_id' )
					->join( 'customers', 'customers.id', '=', 'transactions.customer_id' )
					->join( 'users', 'users.id', '=', 'customers.user_id' );

		if( ! empty( $search ) )
		{
			$model = $model->orWhere(
				function( $query ) use( $search )
				{
					$query->orWhere( 'amazon_product_id', 'LIKE', "%{$search}%" )
							->orWhere( 'customer_name', 'LIKE', "%{$search}%" )
							->orWhere( 'amazon_product_name', 'LIKE', "%{$search}%" )
							->orWhere( 'transaction_amazon_id', 'LIKE', "%{$search}%" )
							->orWhere( 'quantity', 'LIKE', "%{$search}%" )
							->orWhere( 'payout', 'LIKE', "%{$search}%" )
							->orWhere( 'recipient_email', 'LIKE', "%{$search}%" )
							->orWhere( 'recipient_name', 'LIKE', "%{$search}%" );
				}
			);
		}

		return $model->where( 'users.id', '=', \Auth::id() )->paginate( 10 );

	}
}