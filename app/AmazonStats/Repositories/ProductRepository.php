<?php

namespace AmazonStats\Repositories;

use App\AmazonProduct;

class ProductRepository extends EloquentRepository {

	public function __construct( AmazonProduct $amazonProduct )
	{
		$this->model = $amazonProduct;
	}

	public function getAllPerUser( $user = FALSE )
	{
		if( ! $user )
			$user = \Auth::user();

		return $user->products()->get();
	}


}