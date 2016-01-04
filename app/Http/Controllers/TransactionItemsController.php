<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use AmazonStats\Repositories\UserRepository, 
	AmazonStats\Repositories\TransactionRepository,
	AmazonStats\Repositories\TransactionItemRepository;

use AmazonStats\Handlers\ResponseHandlers\JsonResponse;
use Gate;

class TransactionItemsController extends Controller
{
	protected $json;
	protected $transactionItemRepository;

	public function __construct( JsonResponse $json, TransactionItemRepository $transactionItemRepository )
	{
		$this->json = $json;
		$this->transactionItemRepository = $transactionItemRepository;
	}

    public function index()
    {
    	$transactionItems = $this->transactionItemRepository->getAll();
    	return view( 'transaction-items.index', compact( 'transactionItems' ) );
    }
}
