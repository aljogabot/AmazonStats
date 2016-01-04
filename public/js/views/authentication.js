function Authentication()
{
	this.construct();
};

Authentication.prototype = {

	construct : function()
	{
		this.init_login_form();
		this.init_register_form();
		this.init_events();
	},

	init_events : function()
	{
		var $self = this;

		$( '.go-to-registration' ).click(
			function() {
				$( '#signin-container' ).hide();
				$( '#register-container' ).show();
			}
		);

		$( '.go-to-signin' ).click(
			function() {
				$( '#register-container' ).hide();
				$( '#signin-container' ).show();
			}
		);

		$( '.logout-user' ).click(
			function() {
				$BootstrapModalService.setContent( $( '#logout-modal-container' ).html() ).load(
					function() {
						$self.logout_event();
					}
				);

			}
		);
	},

	logout_event : function()
	{
		$( '#modal-container .process-logout' ).click(
			function() {
				$Url.redirect( 'logout' );
			}
		);
	},

	init_login_form : function()
	{
		$( 'form[name=login-form]' ).submit(
			function( $event ) {
				$event.preventDefault();

				var $form   = $( this );
				var $data 	= $form.serialize();
				var $url	= $form.attr( 'action' );

				$FormMessageService.setElement( $form );
				$FormMessageService.notify( 'Processing ...' );

				$http.post( $url, $data,
					function( $json_response ) {
						if( $json_response.success ) {
							$FormMessageService.success( $json_response.message );
							$Url.redirect( $site_config.authticated_home_url );
						} else {
							$FormMessageService.error( $json_response.message );
						}
					}
				);
			}
		);

	},

	init_register_form : function() {

		$( 'form[name=register-form]' ).submit(
			function( $event ) {
				$event.preventDefault();

				var $form   = $( this );
				var $data 	= $form.serialize();
				var $url	= $form.attr( 'action' );

				$FormMessageService.setElement( $form );
				$FormMessageService.notify( 'Processing ...' );

				$http.post( $url, $data,
					function( $json_response ) {
						if( $json_response.success ) {
							$FormMessageService.success( $json_response.message );
							$Url.redirect( $site_config.authticated_home_url );
						} else {
							$FormMessageService.error( $json_response.message );
						}
					}
				);

			}
		);
		
	}

};

var $Authentication;

$( document ).ready(
	function()
	{
		$Authentication = new Authentication;
	}
);