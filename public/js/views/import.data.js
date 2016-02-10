function ImportData()
{
	this.construct();
};

ImportData.prototype = {

	construct : function()
	{
		this.init_fileupload();
	},

	init_fileupload : function()
	{
		$( '#fileupload' ).fileupload({
			url: $( '#fileupload' ).data( 'url' ),
		    maxChunkSize: 1000000, // 1 MB,
		    dataType: 'json',
		    done: function( e, data )
		    {
		    	$FormMessageService.setElement( $( 'form[name=import-data-form]' ) );
		    	if( data.result.success )
		    	{
					$FormMessageService.success( 'Imported Data Successfully ...' );	
					return;
		    	}
		    	$FormMessageService.error( 'Data Import Failed' );	
		    },
		    fail: function(e, data)
		    {
		    	$FormMessageService.setElement( $( 'form[name=import-data-form]' ) );
				$FormMessageService.error( 'Data Import Failed' );

				//$http.post( $site_config.base_url + 'import/remove-session', {} );
		    },
		    progressall: function (e, data) {
	            var progress = parseInt(data.loaded / data.total * 100, 10);
	            $('#progress .progress-bar').css(
	                'width',
	                progress + '%'
	            );
	        },
    		headers: {
		        'X-CSRF-Token': $( 'meta[name="csrf-token"]' ).attr( 'content' )
		    },
		});
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