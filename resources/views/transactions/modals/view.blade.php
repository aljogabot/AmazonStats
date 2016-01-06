<div class="modal-content">
	<form name="transaction-form" action="{{ URL::route( 'save-transaction', [ $transaction->id ] ) }}">
	    <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">View Transaction</h4>
	    </div>
	    <div class="modal-body">
	    	<div class="alert form-message" style="display:none;"></div>

	    	<div class="form-group">
	    		<label for="customer_id">Customer</label>
	    		<select class="form-control" name="customer_id">
	    			@foreach( $customers as $customer )
	    				<option value="{{ $customer->id }}" {{ $customer->id == $transaction->customer_id ? 'selected' : '' }} >{{ $customer->name }}</option>
	    			@endforeach
	    		</select>
	    	</div>

	    	<div class="form-group">
				<label for="amazon_order_id">Amazon Order ID</label>
		        <input type="text" id="amazon_order_id" name="amazon_order_id" class="form-control" placeholder="Amazon Order ID" required autofocus value="{{ $transaction->amazon_order_id }}">
			</div>

			<div class="form-group">
				<label for="recipient_name">Recipient Name</label>
		        <input type="text" id="recipient_name" name="recipient_name" class="form-control" placeholder="Recipient Name" required autofocus value="{{ $transaction->recipient_name }}">
			</div>

			<div class="form-group">
				<label for="recipient_email">Recepient Email</label>
		        <input type="email" id="recipient_email" name="recipient_email" class="form-control" placeholder="Recipient Email" autofocus value="{{ $transaction->recipient_email }}">
			</div>
	    </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary save-transaction">Save</button>
	    </div>
    </form>
</div>