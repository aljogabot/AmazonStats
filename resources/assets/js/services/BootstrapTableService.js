function BoostrapTableService()
{
	this.construct();
};

BoostrapTableService.prototype = {

	container : '',
	url : false,
	current_page : 1,
	search_text : false,

	construct : function()
	{

	},

	setup : function( config )
	{
		this.url = config.url;
	},

	init_events : function()
	{
		var $self = this;

		$( '.previous' ).click(
			function()
			{
				$self.current_page = $( this ).data( 'page' );
			}
		);

		$( '.next' ).click(
			function()
			{
				$self.current_page = $( this ).data( 'page' );
			}
		);

		$( '.page' ).click(
			function()
			{
				$self.current_page = $( this ).data( 'page' );
			}
		);	

	}

};

var $BoostrapTableService;

$( document ).ready(
	function()
	{
		$BoostrapTableService = new BoostrapTableService();
	}
);