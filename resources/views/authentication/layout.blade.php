<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>AmazonStats Authentication</title>

        <!-- styles for this layout -->
        <link rel="stylesheet" type="text/css" href="css/app-all.css" />
    </head>

    <body>

        <div class="container" id="signin-container">

            @include( 'authentication.login' )

        </div> <!-- /container -->

        <div class="container" id="register-container" style="display: none;">

            @include( 'authentication.register' )

        </div> <!-- /container -->

        @include( 'blocks/js-config' )
        
        <script type="text/javascript" src="{{ elixir( 'js/app-all.js' ) }}"></script>

    </body>
</html>