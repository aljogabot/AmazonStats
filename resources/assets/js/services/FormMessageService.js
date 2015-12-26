function FormMessageService() {};

FormMessageService.prototype = {

	element : false,

	setElement : function( $form ) {
		this.element = $form.find( '.alert.form-message' );
	},

	error : function( $message ) {
		this.normal();
		this.element.addClass( 'alert-danger' ).html( $message ).show();
	},

	success : function( $message ) {
		this.normal();
		this.element.addClass( 'alert-success' ).html( $message ).show();
	},

	notify : function( $message ) {
		this.normal();
		this.element.addClass( 'alert-info' ).html( $message ).show();
	},

	normal : function() {
		this.element.attr( 'class', 'alert form-message' ).show();
	},

	hide : function() {
		this.element.attr( 'class', 'alert form-message' ).hide();	
	}

};

var $FormMessageService;

$( document ).ready(
	function() {
		$FormMessageService = new FormMessageService();		
	}
);