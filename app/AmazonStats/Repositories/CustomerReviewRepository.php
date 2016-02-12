<?php

namespace AmazonStats\Repositories;

use App\CustomerReview;

class CustomerReviewRepository extends EloquentRepository {

	public function __construct( CustomerReview $customerReview )
	{
		$this->model = $customerReview;
	}

	public function getAll()
	{
		return $this->model->with( [ 'customer', 'product' ] )
						->paginate();
	}

	public function getAllWithSearch( $search = '' )
	{
		return $this->model->with( [ 'customer', 'product' ] )
						->orWhere( 'notes', 'LIKE', "%{$search}%" )
						->orWhere( 'link', 'LIKE', "%{$search}%" )
						->paginate();
	}

	public function getById( $id )
	{
		return $this->model->with( [ 'customer', 'product' ] )
						->whereId( $id )
						->first();
	}

}