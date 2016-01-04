<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerSaveRequest;

use AmazonStats\Repositories\UserRepository, AmazonStats\Repositories\CustomerRepository;
use AmazonStats\Handlers\ResponseHandlers\JsonResponse;


class CustomersController extends Controller
{
	protected $userRepository;
	protected $contactRepository;
    protected $json;

    public function __construct( JsonResponse $json, UserRepository $userRepository, CustomerRepository $customerRepository )
    {
        $this->json                 = $json;

    	$this->userRepository 		= $userRepository;
        $this->userRepository->setModel( \Auth::user() );

    	$this->customerRepository 	= $customerRepository;
    }

    public function index()
    {
        $customers = $this->userRepository->getAllCustomers();
    	return view( 'customers.index', compact( 'customers' ) );
    }

    public function listTable( Request $request )
    {
        $customers = $this->userRepository->getAllCustomers( $request->search );

        if( $customers->total() > $customers->perPage() )
            $this->json->set( 'paginate_content', $customers->render()->toHtml() );

        return $this->json
                    ->set( 'content', view( 'customers.blocks.list', compact( 'customers' ) )->render() )
                    ->success();       
    }

    public function view( $id )
    {
        $customer = $this->customerRepository->getById( $id );

        if( ! $customer )
        {
            $customer = new \App\Customer;
            $customer->id = 0;
        }

        if( \Gate::denies( 'show', $customer ) && $id != 0 )
            return $this->json->error( 'You Cannot View or Alter Someone\'s Customer ...' );

        $content = \View::make( 'customers.modals.view', compact( 'customer' ) )
                        ->render();

        return $this->json->set( 'content', $content )
                        ->success();                 
    }

    public function save( $id, CustomerSaveRequest $request )
    {
        $customer = $this->customerRepository->getById( $id );

        if( ! $customer )
            $customer = new \App\Customer;

        $customer->fill( $request->all() );
        $customer->setName();

        \Auth::user()->customers()->save( $customer );

        return $this->json->success( 'Customer Saved Successfully ...' );
    }

    public function delete( $id )
    {
        $customer = $this->customerRepository->getById( $id );

        if( \Gate::denies( 'show', $customer ) )
            return $this->json->error( 'You Cannot View or Alter Someone\'s Customer ...' );

        $customer->delete();

        return $this->json->success( 'Customer Deleted Successfully ...' );   
    }
}
