function ImportData()
{
	this.construct();
};

ImportData.prototype = {

	construct : function()
	{
		this.init_events();
		this.init_upload_form();
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

	init_upload_form : function()
	{
		$( 'form[name=import-data-form]' ).submit(
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
							$FormMessageService.success( 'Imported Data Successfully ...' );
						} else {
							$FormMessageService.error( $json_response.message );
						}
					}
				);
			}
		);
	}

};

var $ImportData;

$( document ).ready(
	function()
	{
		$ImportData = new ImportData();
	}
);