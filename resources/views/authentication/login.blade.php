<form class="form-signin" name="login-form" method="POST" action="{{ URL::route( 'login' ) }}">

    <h2 class="form-signin-heading">AmazonStats</h2>
    <h4 class="form-signin-heading">Please sign in</h4>

    <div class="alert form-message"></div>

    <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" required autofocus>    
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>    
    </div>
    
    <div class="checkbox">
        <label>
            <input type="checkbox" name="remember_me" value="TRUE"> Remember me
        </label>
    </div>
    
    <div class="form-group">
        Not Yet A Member?
        <a href="javascript:void(0);" class="go-to-registration">Please Register Here</a>
    </div>
    
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

</form>