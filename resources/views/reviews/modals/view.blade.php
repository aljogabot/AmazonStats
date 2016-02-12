<div class="modal-content">
	<form name="review-form" action="{{ URL::route( 'save-review', [ $review->id ] ) }}">
	    <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">View Review</h4>
	    </div>
	    <div class="modal-body">
	    	<div class="alert form-message" style="display:none;"></div>

	    	<div class="form-group">
	    		<label for="customer_id">Customer</label>
	    		<select class="form-control" name="customer_id" required>
	    			<option value="">Please Select A Customer</option>
	    			@foreach( $customers as $customer )
	    				<option value="{{ $customer->id }}" {{ $customer->id == $review->customer_id ? 'selected' : '' }} >{{ $customer->name }}</option>
	    			@endforeach
	    		</select>
	    	</div>

	    	<div class="form-group">
	    		<label for="amazon_product_id">Product</label>
	    		<select class="form-control" name="amazon_product_id" required>
	    			<option value="">Please Select A Product</option>
	    			@foreach( $products as $product )
	    				<option value="{{ $product->id }}" {{ $product->id == $review->amazon_product_id ? 'selected' : '' }} >{{ $product->name }}</option>
	    			@endforeach
	    		</select>
	    	</div>

	    	<div class="form-group">
				<label for="link">Link</label>
		        <input type="text" id="link" name="link" class="form-control" placeholder="Link" required autofocus value="{{ $review->link }}">
			</div>

			<div class="form-group">
				<label for="notes">Notes</label>
		        <textarea name="notes" class="form-control">{{ $review->notes }}</textarea>
			</div>
	    </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary save-review">Save</button>
	    </div>
    </form>
</div>