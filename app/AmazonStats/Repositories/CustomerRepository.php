<?php

namespace AmazonStats\Repositories;

use App\Customer;

class CustomerRepository extends EloquentRepository {

	public function __construct( Customer $customer )
	{
		$this->model = $customer;
	}

	public function getAllTransactions()
	{
		return $this->model->transactions()->paginate( 10 );
	}

}