<?php

namespace AmazonStats\Repositories;

use App\AmazonProduct;

class AmazonProductRepository extends EloquentRepository {

	public function __construct( AmazonProduct $customer )
	{
		$this->model = $customer;
	}
}