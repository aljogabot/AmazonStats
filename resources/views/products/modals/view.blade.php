<div class="modal-content">
	<form name="product-form" action="{{ URL::route( 'save-product', [ $product->id ] ) }}">
	    <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">View Product</h4>
	    </div>
	    <div class="modal-body">
	    	<div class="alert form-message" style="display:none;"></div>

	    	<div class="form-group">
				<label for="sku">SKU</label>
		        <input type="text" id="sku" name="sku" class="form-control" placeholder="SKU" required autofocus value="{{ $product->sku }}">
			</div>

			<div class="form-group">
				<label for="name">Name</label>
		        <input type="text" id="name" name="name" class="form-control" placeholder="Name" required autofocus value="{{ $product->name }}">
			</div>

			<div class="form-group">
				<label for="price">Price</label>
		        <input type="price" id="price" name="price" class="form-control" placeholder="Price" required autofocus value="{{ $product->price }}">
			</div>
	    </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary save-product">Save</button>
	    </div>
    </form>
</div>