<div class="modal-content">
	<form name="transaction-item-form" action="{{ URL::route( 'save-transaction-item', [ $transactionItem->id ] ) }}">
	    <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">View Transaction Item</h4>
	    </div>
	    <div class="modal-body">
	    	<div class="alert form-message" style="display:none;"></div>

	    	<div class="form-group">
				<label for="transaction_id">Transaction</label>
		        <select class="form-control" name="transaction_id">
		        	@foreach( $transactions as $transaction )
		        		<option value="{{ $transaction->id }}" {{ $transaction->id == $transactionItem->transaction_id ? 'selected' : '' }}>{{ $transaction->customer->name . ' - ' . $transaction->amazon_order_id }}</option>
		        	@endforeach
		        </select>
			</div>

			<div class="form-group">
				<label for="amazon_product_id">Amazon Product</label>
		        <select class="form-control" name="amazon_product_id">
		        	@foreach( $products as $product )
		        		<option value="{{ $product->id }}" {{ $product->id == $transactionItem->amazon_product_id ? 'selected' : '' }} >{{ $product->name }}</option>
		        	@endforeach
		        </select>
			</div>

			<div class="form-group">
				<label for="amazon_order_item_id">Amazon Order Item ID</label>
		        <input type="text" id="amazon_order_item_id" name="amazon_order_item_id" class="form-control" placeholder="Amazon Order Item ID" autofocus value="{{ $transactionItem->amazon_order_item_id }}">
			</div>

			<div class="form-group">
				<label for="quantity">Quantity</label>
		        <input type="text" id="quantity" name="quantity" class="form-control" placeholder="Quantity" required autofocus value="{{ $transactionItem->quantity }}">
			</div>

			<div class="form-group">
				<label for="payout">Payout</label>
				<input type="text" class="form-control" id="payout" name="payout" placeholder="Payout" required autofocus value="{{ $transactionItem->payout }}" />
			</div>
	    </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary save-product">Save</button>
	    </div>
    </form>
</div>