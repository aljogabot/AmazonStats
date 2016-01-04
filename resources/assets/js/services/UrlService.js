function UrlService() {};

UrlService.prototype = {

	redirect : function( $uri ) {
		var $url = this.base() + '/' + $uri;

		if( $uri.indexOf( this.base() ) == 0 )
		{
			$url = $uri;
		}

		$( location ).attr( 'href', $url );
	},

	redirectOutside : function( $url ) {
		$( location ).attr( 'href', $url );
	},

	base : function() {
		return $site_config.base_url;
	}

};

var $Url;

$( document ).ready(
	function() {
		$Url = new UrlService();
	}
);