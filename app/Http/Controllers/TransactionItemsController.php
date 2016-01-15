<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Transaction, App\TransactionItem;

use AmazonStats\Repositories\UserRepository, 
	AmazonStats\Repositories\TransactionRepository,
    AmazonStats\Repositories\ProductRepository,
	AmazonStats\Repositories\TransactionItemRepository;

use AmazonStats\Handlers\ResponseHandlers\JsonResponse;
use Gate;

use App\Http\Requests\TransactionItemSaveRequest;

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
    	$transactionItems = $this->transactionItemRepository->getAllPerUser();
        return view( 'transaction-items.index', compact( 'transactionItems' ) );
    }

    public function transaction( $transactionId, TransactionRepository $transactionRepository )
    {
    	$transaction = Transaction::find( $transactionId );

    	if( Gate::denies( 'show', $transaction ) )
			return redirect()->route( 'customers' );

    	$transactionItems = $transactionRepository->setModel( $transaction )
    								->getAllTransactionItems();

    	return view( 'transaction-items.index', compact( 'transactionItems' ) );
    }

    public function listTable( Request $request )
    {
        $transactionItems = $this->transactionItemRepository->getAllPerUser( $request->search );

        if( $transactionItems->total() > $transactionItems->perPage() )
            $this->json->set( 'paginate_content', $transactionItems->render()->toHtml() );

        return $this->json
                    ->set( 'content', view( 'transaction-items.blocks.list', compact( 'transactionItems' ) )->render() )
                    ->success();
    }

    public function view( $id, TransactionRepository $transactionRepository, ProductRepository $productRepository )
    {
    	$transactionItem = $this->transactionItemRepository->getById( $id );

    	if( $transactionItem && Gate::denies( 'show', $transactionItem ) )
    		return $this->json->redirect( \URL::route( 'customers' ) )
                            ->error();

        if( ! $transactionItem )
        {
        	$transactionItem = new TransactionItem;
        	$transactionItem->id = 0;
            $transactionItem->quantity = 0;
            $transactionItem->item_promotion_discount = 0;
        }

        $transactions = $transactionRepository->getAllPerUser();
        $products = $productRepository->getAllPerUser();

        $content = view( 'transaction-items.modals.view', compact( 'transactions', 'products', 'transactionItem' ) )
                            ->render();

        return $this->json->set( 'content', $content )
                        ->success();
    }

    public function save( $id, TransactionItemSaveRequest $request, ProductRepository $productRepository )
    {
    	$transactionItem = $this->transactionItemRepository->getById( $id );

        if( $transactionItem && Gate::denies( 'save', $transactionItem ) )
            return $this->json->error( 'You cannot alter other\'s Transactions ...' );

        if( ! $transactionItem )
            $transactionItem = new TransactionItem;

        $product = $productRepository->getById( $request->get( 'amazon_product_id' ) );

        if( ! $product )
            return $this->json->error( 'No Product Associated' );

        $transactionItem->fill( $request->except( [ 'transaction_id' ] ) );

        Transaction::find( $request->get( 'transaction_id' ) )
                ->items()
                ->save( $transactionItem );

        return $this->json->success();
    }

    public function delete( $id )
    {
    	$transactionItem = $this->transactionItemRepository->getById( $id );

    	if( ! $transactionItem )
    		return $this->json->error( 'Transaction Item Not Found ...' );

    	if( Gate::denies( 'delete', $transactionItem ) )
    		return $this->json->error( 'You cannot alter other\'s Transactions ...' );

    	$transactionItem->delete();

    	return $this->json->success( 'Transaction Item Deleted Successfully ...' );
    }
}
