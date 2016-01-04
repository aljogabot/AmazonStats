<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use AmazonStats\Repositories\UserRepository, AmazonStats\Repositories\AmazonProductRepository;
use AmazonStats\Handlers\ResponseHandlers\JsonResponse;

use Gate;

class AmazonProductsController extends Controller
{
	protected $userRepository;
	protected $json;
	protected $productRepository;

	public function __construct( JsonResponse $json, UserRepository $userRepository, AmazonProductRepository $productRepository )
	{
		$this->json = $json;
		$this->userRepository = $userRepository;
		$this->productRepository = $productRepository;
	}

    public function index()
    {
    	$products = $this->userRepository->getAllProducts();
    	return view( 'products.index', compact( 'products' ) );
    }

    public function view( $id )
    {
    	
    }
}
