<form class="form-register" name="register-form" method="POST" action="{{ URL::route( 'register' ) }}">
    <h2 class="form-signin-heading">Registration</h2>
    <div class="alert form-message"></div>

    <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" required autofocus>    
    </div>
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" required autofocus>    
    </div>
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" required autofocus>    
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>    
    </div>
    
    <div class="form-group">
        Already A Member?
        <a href="javascript:void(0);" class="go-to-signin">Please Sign In Here</a>
    </div>
    
    <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
</form>