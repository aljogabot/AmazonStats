@extends( 'layout' )
@section( 'content' )
	<div class="row">
        <div class="col-md-5">
            <h1>Reviews</h1>
        </div>
        <div class="col-md-2 pull-right" style="padding-top:20px;">
            <button class="btn btn-primary add-review">Add Review</button>
        </div>
		<div class="col-md-5 pull-right">
			<form name="search-form" id="search-form">
				<div class="form-group">
                  	<label class="control-label" for="search" class="sr-only"></label>
                  	<input class="form-control" id="search" type="text" value="" placeholder="Search for Reviews" />
                </div>
			</form>
		</div>
	</div>
    <div class="pull-right paginate-container">
        {!! $reviews->render() !!}
    </div>
	<table class="table table-bordered">
  		<thead>
        	<tr>
          		<th>#</th>
          		<th>Customer</th>
          		<th>Buyer ID</th>
          		<th>Product</th>
          		<th>Link</th>
                <th>Notes</th>
                <th>Actions</th>
        	</tr>
      	</thead>
      	<tbody id="products-table-list">
        	@include( 'reviews.blocks.list' )
      	</tbody>
    </table>
    <div class="pull-right paginate-container">
        {!! $reviews->render() !!}    
    </div>
@endsection

@section( 'modals' )
    @include( 'reviews.modals.delete' )
@stop

@section( 'page-level-scripts' )
	<script type="text/javascript" src="js/views/reviews.list.js"></script>
@endsection