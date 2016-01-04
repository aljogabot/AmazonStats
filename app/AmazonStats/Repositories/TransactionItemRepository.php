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
}