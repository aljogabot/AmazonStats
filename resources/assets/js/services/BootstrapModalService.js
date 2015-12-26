function BootstrapModalService() {
	this.construct();
};

BootstrapModalService.prototype = {

	modal : false,

	construct : function() {
		this.initialize();
	},

	initialize : function() {

		$( 'body' ).append( '<div id="modal-container" class="modal fade"><div class="modal-dialog"></div></div></div>' );

		$( 'div#modal-container' ).on( 'hide.bs.modal',
			function() {
				$( 'div#modal-container' ).unbind( 'shown' );
				$( 'div#modal-container .modal-dialog' ).html( '' );
			}
		);
			
	},

	load : function( callback ) {

		if( this.modal )  {
			this.modal.modal( 'show' );
		} else {
			this.modal = $( '#modal-container' ).modal( 'show' );	
		}

		/*$( 'div#modal-container' ).on( 'shown.bs.modal', 
			function (e) {
				if( callback ) {
  					callback();
  					$fired = true;
				}
			}
		);*/

		if( callback )
		{
			callback();
		}

		return this;
	},

	unload : function() {
		this.modal.modal( 'hide' );
	},

	setContent : function( $content ) {
		$( 'div#modal-container .modal-dialog' ).html( $content );
		return this;
	},

	getContent : function() {
		return $( 'div#modal-container .modal-dialog' ).html();
	},

	scrollToTitle : function()
	{
		$( "#modal-container" ).animate( { scrollTop: $( 'h4.modal-title' ).offset().top - 80 }, 800 );
	}
	
};

var $BootstrapModalService;

$( document ).ready(
	function() {
		$BootstrapModalService = new BootstrapModalService();
	}
);