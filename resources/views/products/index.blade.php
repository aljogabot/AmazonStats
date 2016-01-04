@extends( 'layout' )
@section( 'content' )
	<div class="row">
        <div class="col-md-5">
            <h1>Amazon Products</h1>
        </div>
        <div class="col-md-2 pull-right" style="padding-top:20px;">
            <button class="btn btn-primary add-product">Add Product</button>
        </div>
		<div class="col-md-5 pull-right">
			<form name="search-form" id="search-form">
				<div class="form-group">
                  	<label class="control-label" for="search" class="sr-only"></label>
                  	<input class="form-control" id="search" type="text" value="" placeholder="Search for Products" />
                </div>
			</form>
		</div>
	</div>
    <div class="pull-right paginate-container">
        {!! $products->render() !!}
    </div>
	<table class="table table-bordered">
  		<thead>
        	<tr>
          		<th>#</th>
          		<th>SKU</th>
          		<th>Name</th>
          		<th>Price</th>
          		<th>Actions</th>
        	</tr>
      	</thead>
      	<tbody id="customers-table-list">
        	@include( 'products.blocks.list' )
      	</tbody>
    </table>
    <div class="pull-right paginate-container">
        {!! $products->render() !!}    
    </div>
@endsection

@section( 'modals' )
    @include( 'products.modals.delete' )
@stop

@section( 'page-level-scripts' )
	<script type="text/javascript" src="js/views/products.list.js"></script>
@endsection