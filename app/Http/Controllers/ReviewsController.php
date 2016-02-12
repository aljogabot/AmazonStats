<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use AmazonStats\Repositories\UserRepository, AmazonStats\Repositories\AmazonProductRepository;
use AmazonStats\Repositories\CustomerReviewRepository;
use AmazonStats\Handlers\ResponseHandlers\JsonResponse;

use Gate, Auth, View, App\CustomerReview;

class ReviewsController extends Controller
{
	protected $json;
	protected $customerReviewRepository;

	public function __construct( JsonResponse $json, CustomerReviewRepository $customerReviewRepository )
	{
		$this->json = $json;
        $this->customerReviewRepository = $customerReviewRepository;
	}

    public function index()
    {
    	$reviews = $this->customerReviewRepository->getAll();
    	return view( 'reviews.index', compact( 'reviews' ) );
    }

    public function listTable( Request $request )
    {
        $products = $this->userRepository->getAllProducts( $request->search );

        if( $products->total() > $products->perPage() )
            $this->json->set( 'paginate_content', $products->render()->toHtml() );

        return $this->json
                    ->set( 'content', view( 'products.blocks.list', compact( 'products' ) )->render() )
                    ->success();       
    }

    public function view( $id )
    {
    	$product = $this->productRepository->getById( $id );

        if( ! $product )
        {
            $product = new AmazonProduct;
            $product->id = 0;
        }

        if( Gate::denies( 'show', $product ) && $id != 0 )
            return $this->json->error( 'You Cannot View or Alter Someone\'s Product ...' );

        $content = View::make( 'products.modals.view', compact( 'product' ) )
                        ->render();

        return $this->json->set( 'content', $content )
                        ->success();                 
    }

    public function save( $id, ProductSaveRequest $request )
    {
        $product = $this->productRepository->getById( $id );

        if( ! $product )
            $product = new AmazonProduct;

        $product->fill( $request->all() );
        
        Auth::user()->products()->save( $product );

        return $this->json->success( 'Product Saved Successfully ...' );
    }

    public function delete( $id )
    {
        $product = $this->productRepository->getById( $id );

        if( Gate::denies( 'show', $product ) )
            return $this->json->error( 'You Cannot View or Alter Someone\'s Product ...' );

        $product->delete();

        return $this->json->success( 'Product Deleted Successfully ...' );   
    }

    public function getPrice( Request $request )
    {
        $product = $this->productRepository->getById( $request->get( 'id' ) );
        return $this->json->set( 'product_price', $product->price )
                        ->success();
    }
}
