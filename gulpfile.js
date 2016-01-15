var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(
	function( $mix ) {

		// Copy Bower Dependencies to Resources Folder ...
    	$mix.copy( 'resources/assets/bower_components/jquery/dist/jquery.min.js', 'resources/assets/js/libs/jquery.min.js' );
		$mix.copy( 'resources/assets/bower_components/bootstrap/dist/js/bootstrap.min.js', 'resources/assets/js/libs/bootstrap.min.js' );
		
		$mix.copy( 'resources/assets/js/views', 'public/js/views' );
		$mix.copy( 'resources/assets/fonts', 'public/fonts' );
		$mix.copy( 'resources/assets/images', 'public/images' );

		$mix.copy( 'resources/assets/bower_components/blueimp-file-upload/js', 'resources/assets/js/libs/blueimp-file-upload' );

		$mix.styles(
			[
				'fonts.css',
				'bootstrap.min.css',
				'application.css'
			],
			'public/css/app-all.css'
		);

		$mix.scripts(
			[
				'libs/jquery.min.js',
				'libs/bootstrap.min.js',
				'libs/blueimp-file-upload/vendor/jquery.ui.widget.js',
				'libs/blueimp-file-upload/jquery.fileupload.js',
				'services/UrlService.js',
				'services/AjaxService.js',
				'services/FormMessageService.js',
				'services/BootstrapModalService.js',
				'views/authentication.js'
			],
			'public/js/app-all.js'
		).version( 'public/js/app-all.js', 'public/build' );

	}
);
