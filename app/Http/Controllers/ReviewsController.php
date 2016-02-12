<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use AmazonStats\Repositories\CustomerReviewRepository;
use AmazonStats\Handlers\ResponseHandlers\JsonResponse;

use Gate, Auth, View, App\CustomerReview, App\AmazonProduct, App\Customer;

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
        $reviews = $this->customerReviewRepository->getAllWithSearch( $request->search );

        if( $reviews->total() > $reviews->perPage() )
            $this->json->set( 'paginate_content', $reviews->render()->toHtml() );

        return $this->json
                    ->set( 'content', view( 'reviews.blocks.list', compact( 'reviews' ) )->render() )
                    ->success();       
    }

    public function view( $id )
    {
    	$review = $this->customerReviewRepository->getById( $id );

        if( ! $review )
        {
            $review = new CustomerReview;
            $review->id = 0;
        }

        $products   = AmazonProduct::all();
        $customers   = Customer::where( 'user_id', '=', auth()->user()->id )
                                ->get();

        $content = View::make( 'reviews.modals.view', compact( 'review', 'products', 'customers' ) )
                        ->render();

        return $this->json->set( 'content', $content )
                        ->success();                 
    }

    public function save( $id, Request $request )
    {
        $review = $this->customerReviewRepository->getById( $id );

        if( ! $review )
            $review = new CustomerReview;

        $review->fill( $request->all() );
        
        $review->save();

        return $this->json->success( 'Review Saved Successfully ...' );
    }

    public function delete( $id )
    {
        $review = $this->customerReviewRepository->getById( $id );

        $review->delete();

        return $this->json->success( 'Review Deleted Successfully ...' );   
    }

}
