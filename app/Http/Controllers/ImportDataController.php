<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ImportDataController extends Controller
{
    protected $json;
    protected $userRepository;
    protected $customerRepository;
    protected $transactionRepository;
    protected $productRepository;

    public function __construct( JsonResponse $json, UserRepository $userRepository )
    {
    	$this->json = $json;
    	$this->userRepository = $userRepository;
    }

	public function index()
	{
		return view( 'import.index' );
	}

	public function process()
	{
		
	}

}
