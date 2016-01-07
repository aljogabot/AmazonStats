<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use AmazonStats\Handlers\ResponseHandlers\JsonResponse;
use AmazonStats\Repositories\UserRepository;

use Auth, App\Customer, App\Transaction, App\TransactionItem, App\AmazonProduct;

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

	public function process( Request $request )
	{
		$file = $request->file( 'file' );

        if( empty( $file ) )
            return $this->json->error( 'Please Upload a File ...' );

        $fileContents = file_get_contents( $file );

        $fileLines = explode( "\r\n", $fileContents );
        $maxLineCount = count( $fileLines );

        $user = Auth::user();

        for( $x = 0; $x < $maxLineCount; $x++ )
        {
            if( $x == 0 )
                continue;

            $lineArray = explode( "\t", $fileLines[ $x ] );

            $customerEmail = $lineArray[10];
            $customerName = $lineArray[11];

            $amazonOrderId = $lineArray[0];
            $recipientName = $lineArray[24];

            $amazonOrderItemId = $lineArray[4];

            $itemQuantity = $lineArray[15];

            $productSku = $lineArray[13];
            $productName = $lineArray[14];
            $productPrice = $lineArray[17];

            $customer = Customer::where( 'email', '=', $customerEmail )
                                ->where( 'user_id', '=', $user->id )
                                ->first();
            if( ! $customer ) 
            {
                $customer = new Customer;
                $customer->fill( [ 'email' => $customerEmail, 'name' => $customerName ] );
                $customer = $user->customers()->save( $customer );
            } else {
                $customer->name = $customerName;
                $customer->save();
            }

            $transaction = Transaction::whereAmazonOrderId( $amazonOrderId )
                                    ->where( 'customer_id', '=', $customer->id )
                                ->first();

            if( ! $transaction )
            {
                $transaction = new Transaction;
                $transaction->fill( [ 'amazon_order_id' => $amazonOrderId, 'recipient_name' => $recipientName ] );
                $transaction = $customer->transactions()->save( $transaction );
            } else {
                $transaction->recipient_name = $recipientName;
                $transaction->save();
            }

            // Products ...
            $product = AmazonProduct::whereSku( $productSku )
                                ->where( 'user_id', '=', $user->id )
                            ->first();

            if( ! $product )
            {
                $product = new AmazonProduct;
                $product->fill( [ 'sku' => $productSku, 'name' => $productName, 'price' => $productPrice ] );
                $product = $user->products()->save( $product );

            } else {
                $product->name = $productName;
                $product->price = $productPrice;
                $product->save();
            }

            $payout = $itemQuantity * $product->price;

            $transactionItem = TransactionItem::whereAmazonOrderItemId( $amazonOrderItemId )
                                        ->where( 'transaction_id', '=', $transaction->id )
                                        ->first();

            if( ! $transactionItem )
            {
                $transactionItem = new TransactionItem;
                $arrayData = [ 'amazon_product_id' => $product->id, 'amazon_order_item_id' => $amazonOrderItemId, 'quantity' => $itemQuantity, 'payout' => $payout ];
                $transactionItem->fill( $arrayData );
                $transaction->items()->save( $transactionItem );
            } else {
                $transactionItem->amazon_product_id = $product->id;
                $transactionItem->quantity = $itemQuantity;
                $transactionItem->payout = $payout;
                $transactionItem->save();
            }

        }
        
        return $this->json->success( 'SUCCESS!!! Import data done ....' );

	}

}
