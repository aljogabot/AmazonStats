<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['web']], function () {

	Route::get( '/', [ 'as' => 'home', 'uses' => 'AuthenticationController@index' ] );
	Route::post( '/login', [ 'as' => 'login', 'uses' => 'AuthenticationController@login' ] );
	Route::post( '/register', [ 'as' => 'register', 'uses' => 'AuthenticationController@register' ] );
	Route::get( '/logout', 'AuthenticationController@logout' );

	Route::group( [ 'middleware' => [ 'auth' ] ], 
		function()
		{
			Route::group( [ 'prefix' => 'customers' ],
				function()
				{
					Route::get( '/', [ 'as' => 'customers', 'uses' => 'CustomersController@index' ] );
					Route::post( '/', [ 'as' => 'customers-list-ajax', 'uses' => 'CustomersController@listTable' ] );

					Route::post( 'view/{id}', [ 'as' => 'view-customer', 'uses' => 'CustomersController@view' ] );
					Route::post( 'save/{id}', [ 'as' => 'save-customer', 'uses' => 'CustomersController@save' ] );
					Route::post( 'delete/{id}', [ 'as' => 'delete-customer', 'uses' => 'CustomersController@delete' ] );
				}
			);

			Route::group( [ 'prefix' => 'transactions' ],
				function()
				{
					Route::get( '/', [ 'as' => 'transactions', 'uses' => 'TransactionsController@index' ] );
					Route::get( 'customer/{customerId}', [ 'as' => 'customer-transactions', 'uses' => 'TransactionsController@customer' ] );

					Route::post( '/', [ 'as' => 'transactions-list-ajax', 'uses' => 'TransactionsController@listTable' ] );

					Route::post( 'view/{id}', [ 'as' => 'view-transaction', 'uses' => 'TransactionsController@view' ] );
					Route::post( 'save/{id}', [ 'as' => 'save-transaction', 'uses' => 'TransactionsController@save' ] );
					Route::post( 'delete/{id}', [ 'as' => 'delete-transaction', 'uses' => 'TransactionsController@delete' ] );
				}
			);

			Route::group( [ 'prefix' => 'transaction-items' ],
				function()
				{
					Route::get( '/', [ 'as' => 'transaction-items', 'uses' => 'TransactionItemsController@index' ] );
					
				}
			);

			Route::group( [ 'prefix' => 'products' ],
				function()
				{
					Route::get( '/', [ 'as' => 'products', 'uses' => 'AmazonProductsController@index' ] );
					Route::post( '/', [ 'as' => 'products-list-ajax', 'uses' => 'AmazonProductsController@listTable' ] );

					Route::post( 'view/{id}', [ 'as' => 'view-product', 'uses' => 'AmazonProductsController@view' ] );
					Route::post( 'save/{id}', [ 'as' => 'save-product', 'uses' => 'AmazonProductsController@save' ] );
					Route::post( 'delete/{id}', [ 'as' => 'delete-product', 'uses' => 'AmazonProductsController@delete' ] );
				}
			);
		}
	);

});