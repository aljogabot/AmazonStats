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

			<div class="form-group">
				<label for="ship_address_1">Ship Address 1</label>
		        <textarea name="ship_address_1" class="form-control">{{ $transaction->ship_address_1 }}</textarea>
			</div>

			<div class="form-group">
				<label for="ship_address_2">Ship Address 2</label>
		        <textarea name="ship_address_2" class="form-control">{{ $transaction->ship_address_2 }}</textarea>
			</div>

			<div class="form-group">
				<label for="ship_address_3">Ship Address 3</label>
		        <textarea name="ship_address_3" class="form-control">{{ $transaction->ship_address_3 }}</textarea>
			</div>

			<div class="form-group">
				<label for="ship_city">Ship City</label>
		        <input type="text" id="ship_city" name="ship_city" class="form-control" placeholder="Ship City" autofocus value="{{ $transaction->ship_city }}">
			</div>

			<div class="form-group">
				<label for="ship_state">Ship State</label>
		        <input type="text" id="ship_state" name="ship_state" class="form-control" placeholder="Ship State" autofocus value="{{ $transaction->ship_state }}">
			</div>

			<div class="form-group">
				<label for="ship_postal_code">Ship Postal Code</label>
		        <input type="text" id="ship_postal_code" name="ship_postal_code" class="form-control" placeholder="Ship Postal Code" autofocus value="{{ $transaction->ship_postal_code }}">
			</div>

			<div class="form-group">
				<label for="ship_postal_country">Ship Postal Country</label>
		        <input type="text" id="ship_postal_country" name="ship_postal_country" class="form-control" placeholder="Ship Postal Country" autofocus value="{{ $transaction->ship_postal_country }}">
			</div>

			<div class="form-group">
				<label for="carrier">Carrier</label>
		        <input type="text" id="carrier" name="carrier" class="form-control" placeholder="Carrier" autofocus value="{{ $transaction->carrier }}">
			</div>

			<div class="form-group">
				<label for="tracking_number">Tracking Number</label>
		        <input type="text" id="tracking_number" name="tracking_number" class="form-control" placeholder="Tracking Number" autofocus value="{{ $transaction->tracking_number }}">
			</div>
	    </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary save-transaction">Save</button>
	    </div>
    </form>
</div>