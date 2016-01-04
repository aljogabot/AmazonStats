<script type="text/javascript">
	var $site_config = {
		'base_url' 				: '{{ URL::route( "home" ) }}',
		'current_url'			: '{{ Request::url() }}',
		'authticated_home_url'	: '{{ URL::route( "customers" ) }}'
	};
</script>