<div class="modal-content">
	<form name="customer-form" action="{{ URL::route( 'save-customer', [ $customer->id ] ) }}">
	    <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">View Customer</h4>
	    </div>
	    <div class="modal-body">
	    	<div class="alert form-message" style="display:none;"></div>

	    	<div class="form-group">
				<label for="first_name">First Name</label>
		        <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" autofocus value="{{ $customer->first_name }}">
			</div>

			<div class="form-group">
				<label for="last_name">Last Name</label>
		        <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" autofocus value="{{ $customer->last_name }}">
			</div>

			<div class="form-group">
				<label for="name">Name</label>
		        <input type="text" id="name" name="name" class="form-control" placeholder="Name" autofocus value="{{ $customer->name }}">
			</div>

			<div class="form-group">
				<label for="email">Email Address</label>
		        <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" required autofocus value="{{ $customer->email }}">
			</div>
	    </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary save-customer">Save</button>
	    </div>
    </form>
</div>