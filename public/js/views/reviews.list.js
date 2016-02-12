function ReviewsList()
{
	this.construct();
};

ReviewsList.prototype = {

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
			'/reviews?page=' + this.current_page,
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

					$( '#reviews-table-list' ).html( $json_response.content );
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

		$( '.add-review' ).click(
			function( $event ) {
				$event.preventDefault();

				$http.post( 'reviews/view/0', {},
					function( $json_response ) {
						if( $json_response.success ) {
							$BootstrapModalService.setContent( $json_response.content ).load(
								function()
								{
									$self.init_review_form();
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

		$( '.edit-review' ).click(
			function( $event ) {
				$event.preventDefault();

				var $id = $( this ).parent().data( 'id' );

				$http.post( 'reviews/view/' + $id, {},
					function( $json_response ) {
						if( $json_response.success ) {
							$BootstrapModalService.setContent( $json_response.content ).load(
								function()
								{
									$self.init_review_form();
								}
							);
						} else {
							alert( 'Error' );
						}
					}
				);
			}
		);

		$( '.delete-review' ).click(
			function( $event )
			{
				$event.preventDefault();

				var $name =	$( this ).parent().data( 'name' );
				var $url = $( this ).parent().data( 'delete-url' );

				$BootstrapModalService.setContent( $( '#delete-review-modal-container' ).html() ).load(
					function() {
						$( '#modal-container span.name' ).html( $name );
						$( '#modal-container .process-delete-review' ).data( 'url', $url );
						$self.delete_review();
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

	init_review_form : function()
	{
		var $self = this;

		$( 'form[name=review-form]' ).submit(
			function( $event ) {
				$event.preventDefault();
					
				var $form = $( this );
				var $data = $form.serialize();

				$FormMessageService.setElement( $form );
				$FormMessageService.notify( 'Processing ...' );

				$http.post( $form.attr( 'action' ), $data,
					function( $json_response ) {
						if( $json_response.success ) {
							$( '#reviews-table-list' ).html( $json_response.reviews );
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

	delete_review : function()
	{
		var $self = this;
		$( '#modal-container .process-delete-review' ).click(
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

var $ReviewsList;

$( document ).ready(
	function()
	{
		$ReviewsList = new ReviewsList();
	}
);