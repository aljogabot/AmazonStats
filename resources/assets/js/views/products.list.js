function ProductsList()
{
	this.construct();
};

ProductsList.prototype = {

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
			'/products?page=' + this.current_page,
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

					$( '#products-table-list' ).html( $json_response.content );
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

		$( '.add-product' ).click(
			function( $event ) {
				$event.preventDefault();

				$http.post( 'products/view/0', {},
					function( $json_response ) {
						if( $json_response.success ) {
							$BootstrapModalService.setContent( $json_response.content ).load(
								function()
								{
									$self.init_product_form();
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

		$( '.edit-product' ).click(
			function( $event ) {
				$event.preventDefault();

				var $id = $( this ).parent().data( 'id' );

				$http.post( 'products/view/' + $id, {},
					function( $json_response ) {
						if( $json_response.success ) {
							$BootstrapModalService.setContent( $json_response.content ).load(
								function()
								{
									$self.init_product_form();
								}
							);
						} else {
							alert( 'Error' );
						}
					}
				);
			}
		);

		$( '.delete-product' ).click(
			function( $event )
			{
				$event.preventDefault();

				var $name =	$( this ).parent().data( 'name' );
				var $url = $( this ).parent().data( 'delete-url' );

				$BootstrapModalService.setContent( $( '#delete-product-modal-container' ).html() ).load(
					function() {
						$( '#modal-container span.name' ).html( $name );
						$( '#modal-container .process-delete-product' ).data( 'url', $url );
						$self.delete_product();
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

	init_product_form : function()
	{
		var $self = this;

		$( 'form[name=product-form]' ).submit(
			function( $event ) {
				$event.preventDefault();
					
				var $form = $( this );
				var $data = $form.serialize();

				$FormMessageService.setElement( $form );
				$FormMessageService.notify( 'Processing ...' );

				$http.post( $form.attr( 'action' ), $data,
					function( $json_response ) {
						if( $json_response.success ) {
							$( '#products-table-list' ).html( $json_response.products );
							$BootstrapModalService.unload();
							$self.refresh_table();
						} else {
							$FormMessageService.error( $json_response.message );
						}
					}
				);

			}
		);
	},

	delete_product : function()
	{
		var $self = this;
		$( '#modal-container .process-delete-product' ).click(
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

var $ProductsList;

$( document ).ready(
	function()
	{
		$ProductsList = new ProductsList();
	}
);