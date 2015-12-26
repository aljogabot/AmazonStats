function KeywordsIndex()
{
	this.construct();
};

KeywordsIndex.prototype = {

	construct : function()
	{
		this.init_main_form();
		this.init_events();
	},

	init_main_form : function()
	{
		var $self = this;

		$( 'form[name=keywords-form]' ).submit(
			function( $event )
			{
				$event.preventDefault();
				var $form = $( this );

				var $data = new FormData( $form[0] );

				$FormMessageService.setElement( $form );
				$FormMessageService.notify( 'Processing ...' );

				$http.postUpload( $form.attr( 'action' ), $data,
					function( $json_response ) {
						if( $json_response.success ) {
							$BootstrapModalService.setContent( $json_response.content ).load(
								function()
								{
									$self.init_first_preview_form();
								}
							);
							$FormMessageService.notify( 'This is an App where you can multiply your selected keywords ...' );
						} else {
							$FormMessageService.error( $json_response.message );
						}
					}
				);
			}
		);
	},

	init_events : function()
	{
		$( '.upload' ).change(
			function()
			{
				$( '#file_label' ).val( $( this ).val() );
			}
		);
	},

	init_first_preview_form : function()
	{
		var $self = this;

		$( "#modal-container" ).animate( { scrollTop: $( 'h4.modal-title' ).offset().top - 80 }, 800 );

		$( 'form[name=keywords-first-preview-form]' ).submit(
			function( $event )
			{
				$event.preventDefault();
				var $form = $( this );
				var $data = $form.serialize();

				$FormMessageService.setElement( $form );
				$FormMessageService.notify( 'Processing ...' );

				$http.post( $form.attr( 'action' ), $data,
					function( $json_response ) {
						if( $json_response.success ) {
							$BootstrapModalService.setContent( $json_response.content ).load(
								function()
								{
									$self.init_second_preview_form();
								}
							).scrollToTitle();
						} else {
							$FormMessageService.error( $json_response.message );
						}
					}
				);
			}
		);
	},

	init_second_preview_form : function()
	{
		var $self = this;

		$( '.back-to-first-selection' ).click(
			function( $event ) 
			{
				$event.preventDefault();
				$http.post(
					$( this ).data( 'url' ), {}, 
					function( $json_response )
					{
						if( $json_response.success )
						{
							$BootstrapModalService.setContent( $json_response.content ).load(
								function()
								{
									$self.init_first_preview_form();
								}
							).scrollToTitle();
						}
					}
				);
			}
		);
		
		$( 'form[name=keywords-second-preview-form]' ).submit(
			function( $event )
			{
				$event.preventDefault();
				var $form = $( this );
				var $data = $form.serialize();

				$FormMessageService.setElement( $form );
				$FormMessageService.notify( 'Processing ...' );

				$http.post( $form.attr( 'action' ), $data,
					function( $json_response ) {
						if( $json_response.success ) {
							$BootstrapModalService.setContent( $json_response.content ).load(
								function()
								{
									$self.init_download_to_file();
								}
							).scrollToTitle();
						} else {
							$FormMessageService.error( $json_response.message );
						}
					}
				);
			}
		);

	},

	init_download_to_file : function()
	{
		var $self = this;

		$( '.back-to-second-selection' ).click(
			function( $event ) 
			{
				$event.preventDefault();
				$http.post(
					$( this ).data( 'url' ), {}, 
					function( $json_response )
					{
						if( $json_response.success )
						{
							$BootstrapModalService.setContent( $json_response.content ).load(
								function()
								{
									$self.init_second_preview_form();
								}
							).scrollToTitle();
						}
					}
				);
			}
		);
	}

};

var $KeywordsIndex;

$( document ).ready(
	function()
	{
		$KeywordsIndex = new KeywordsIndex();
	}
);