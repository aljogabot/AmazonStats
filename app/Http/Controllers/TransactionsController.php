<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\SaveTransactionRequest;

use AmazonStats\Repositories\UserRepository, 
	AmazonStats\Repositories\CustomerRepository,
	AmazonStats\Repositories\TransactionRepository;

use AmazonStats\Handlers\ResponseHandlers\JsonResponse;
use Gate;

class TransactionsController extends Controller
{
    protected $userRepository;
	protected $contactRepository;
    protected $transactionRepository;

    protected $json;

    public function __construct( JsonResponse $json, TransactionRepository $transactionRepository )
    {
    	$this->json = $json;
        $this->transactionRepository = $transactionRepository;
    }

    public function index( UserRepository $userRepository )
    {
    	$transactions = $this->transactionRepository->getAllPerUser();
        return view( 'transactions.index', compact( 'transactions' ) );
    }

    public function listTable( Request $request )
    {
        $transactions = $this->transactionRepository->getAllPerUser( $request->search );

        if( $transactions->total() > $transactions->perPage() )
            $this->json->set( 'paginate_content', $transactions->render()->toHtml() );

        return $this->json
                    ->set( 'content', view( 'transactions.blocks.list', compact( 'transactions' ) )->render() )
                    ->success();
    }

    public function customer( $customerId, CustomerRepository $customerRepository )
    {
    	$customer = \App\Customer::find( $customerId );

    	if( Gate::denies( 'show', $customer ) )
			return redirect()->route( 'customers' ); 	

    	$transactions = $customerRepository->setModel( $customer )
    								->getAllTransactions();

        return view( 'transactions.index', compact( 'transactions' ) );
    }

    public function view( $id, UserRepository $userRepository )
    {
        $transaction = $this->transactionRepository->getById( $id );

        if( $transaction && Gate::denies( 'show', $transaction ) )
            return $this->json->redirect( \URL::route( 'transactions' ) )
                            ->error();

        if( ! $transaction ) 
        {
            $transaction = new \App\Transaction;
            $transaction->id = 0;
        }

        $customers = $userRepository->getAllCustomers();

        $content = view( 'transactions.modals.view', compact( 'transaction', 'customers' ) )
                            ->render();

        return $this->json->set( 'content', $content )
                        ->success();
    }

    public function save( $id, SaveTransactionRequest $request )
    {
        $transaction = $this->transactionRepository->getById( $id );

        if( $transaction && Gate::denies( 'save', $transaction ) )
            return $this->json->error( 'You cannot alter other\'s transactions ...' );

        if( ! $transaction )
            $transaction = new \App\Transaction;

        $transaction->fill( $request->except( [ 'customer_id' ] ) );

        \App\Customer::find( $request->get( 'customer_id' ) )
                ->transactions()
                ->save( $transaction );

        return $this->json->success();
    }

    public function delete( $id )
    {
        $transaction = $this->transactionRepository->getById( $id );

        if( ! $transaction )
            return $this->json->error( 'You cannot alter other\'s transactions ...' );

        if( Gate::denies( 'delete', $transaction ) )
            return $this->json->error( 'You cannot alter other\'s transactions ...' );

        $transaction->delete();

        return $this->json->success( 'Transaction Saved Successfully ...' );   
    }
}
