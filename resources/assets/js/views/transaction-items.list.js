function TransactionItemsList()
{
	this.construct();
};

TransactionItemsList.prototype = {

	current_page : 1,
	search_text : '',

	construct : function() {
		this.init_events();
		this.init_table_events();
	},

	refresh_table : function()
	{
		var $self = this;
		$http.post(
			'/transaction-items?page=' + this.current_page,
			{ search : this.search_text },
			function( $json_response )
			{
				if( $json_response.success )
				{
					if( $json_response.paginate_content ) {
						$( '.paginate-container' ).html( $json_response.paginate_content );
					} else {
						$( '.paginate-container' ).html( '' );
					}

					$( '#transaction-items-table-list' ).html( $json_response.content );
					$self.init_table_events();
				} else {
					alert( 'Error on Refreshing Table ...' );
				}	
			}
		);
	},

	init_events : function()
	{
		var $self = this;

		$( '.add-transaction-item' ).click(
			function( $event ) {
				$event.preventDefault();

				$http.post( '/transaction-items/view/0', {},
					function( $json_response ) {
						if( $json_response.success ) {
							$BootstrapModalService.setContent( $json_response.content ).load(
								function()
								{
									$self.init_transaction_item_form();
								}
							);
						} else {
							alert( 'Error' );
						}
					}
				);
			}
		);

		$( '#search' ).keyup(
			function( $event ) {
				var $text = $( this ).val();

				if( $text.length < 3 && $text.length != 0 )
				{
					return false;
				}

				$self.search_text = $text;
				$self.current_page = 1;

				$self.refresh_table();
			}
		);

		$( '#search-form' ).submit(
			function( $event )
			{
				$event.preventDefault();
				$self.refresh_table();
			}
		);
	},

	init_table_events : function()
	{
		var $self = this;

		$( '.edit-transaction-item' ).click(
			function( $event ) {
				$event.preventDefault();

				var $id = $( this ).parent().data( 'id' );

				$http.post( '/transaction-items/view/' + $id, {},
					function( $json_response ) {
						if( $json_response.success ) {
							$BootstrapModalService.setContent( $json_response.content ).load(
								function()
								{
									$self.init_transaction_item_form();
								}
							);
						} else {
							alert( 'Error' );
						}
					}
				);
			}
		);

		$( '.delete-transaction-item' ).click(
			function( $event )
			{
				$event.preventDefault();

				var $amazon_product_name = $( this ).parent().data( 'amazon-product-name' );
				var $url = $( this ).parent().data( 'delete-url' );

				$BootstrapModalService.setContent( $( '#delete-transaction-item-modal-container' ).html() ).load(
					function() {
						$( '#modal-container span.name' ).html( $amazon_product_name );
						$( '#modal-container .process-delete-transaction-item' ).data( 'url', $url );
						$self.delete_transaction_item();
					}
				);
			}
		);

		$( '.pagination li a' ).click(
			function( $event )
			{
				$event.preventDefault();

				var $page = $( this ).html();

				if( $page.trim() == '«' ) {
					$self.current_page--;
				} else if( $page.trim() == '»' ) {
					$self.current_page++;
				} else {
					$self.current_page = parseInt( $page );
				}

				$self.refresh_table();
			}
		);
	},

	init_transaction_item_form : function()
	{
		var $self = this;

		$self.update_payout();

		$( 'form[name=transaction-item-form]' ).submit(
			function( $event ) {
				$event.preventDefault();
					
				var $form = $( this );
				var $data = $form.serialize();

				$FormMessageService.setElement( $form );
				$FormMessageService.notify( 'Processing ...' );

				$http.post( $form.attr( 'action' ), $data,
					function( $json_response ) {
						if( $json_response.success ) {
							$( '#transaction-items-table-list' ).html( $json_response.customers );
							$BootstrapModalService.unload();
							$self.refresh_table();
						} else {
							$FormMessageService.error( $json_response.message );
						}
					}
				);

			}
		);

		$( '#amazon_product_id' ).change(
			function()
			{
				var $productSelectElement = $( '#amazon_product_id' );
				var $productId = $( this ).val();

				$http.post( '/products/get-price', { id : $productId },
					function( $json_response ) {
						if( $json_response.success ) {
							$productSelectElement.data( 'selected-product-price', $json_response.product_price );
							$self.update_payout();
						} else {
							alert( 'error from getting product price ...' );
							return false;
						}
					}
				);
			}
		);

		$( '#quantity' ).keyup(
			function()
			{
				if( $( this ).val().length == 0 )
					$( this ).val( 0 );

				$self.update_payout();
			}
		);

		$( '#item_promotion_discount' ).keyup(
			function()
			{
				if( $( this ).val().length == 0 )
					$( this ).val( 0 );

				$self.update_payout();
			}
		);

	},

	update_payout : function()
	{
		var $selectedProductPrice = $( '#amazon_product_id' ).data( 'selected-product-price' );
		var $quantity = $( '#quantity' ).val();
		var $promotionalDiscount = $( '#item_promotion_discount' ).val();

		$quantity = $quantity == 0 ? 0 : $quantity;
		$selectedProductPrice = $promotionalDiscount == 0 ? $selectedProductPrice : $selectedProductPrice - $promotionalDiscount;

		$( '#payout' ).val( $selectedProductPrice * $quantity );		
	},

	delete_transaction_item : function()
	{
		var $self = this;
		$( '#modal-container .process-delete-transaction-item' ).click(
			function() {
				$( 'div#modal-container .alert' ).attr( 'class', 'alert alert-info' ).html( 'Deleting ...' ).show();

				var $url = $( this ).data( 'url' );

				$http.post( $url, {},
					function( $json_response ) {
						if( $json_response.success ) {
							$BootstrapModalService.unload();
							$self.refresh_table();
						} else {
							$( 'div#modal-container .alert' ).html( $json_response.message ).show();
						}
					}
				);
				
			}
		);
	}

};

var $TransactionItemsList;

$( document ).ready(
	function()
	{
		$TransactionItemsList = new TransactionItemsList();
	}
);