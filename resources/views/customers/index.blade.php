@extends( 'layout' )
@section( 'content' )
	<div class="row">
        <div class="col-md-5">
            <h1>Customers</h1>
        </div>
        <div class="col-md-2 pull-right" style="padding-top:20px;">
            <button class="btn btn-primary add-customer">Add Customer</button>
        </div>
		<div class="col-md-5 pull-right">
			<form name="search-form" id="search-form">
				<div class="form-group">
                  	<label class="control-label" for="search" class="sr-only"></label>
                  	<input class="form-control" id="search" type="text" value="" placeholder="Search for Customers" />
                </div>
			</form>
		</div>
	</div>
    <div class="pull-right paginate-container">
        {!! $customers->render() !!}
    </div>
	<table class="table table-bordered">
  		<thead>
        	<tr>
          		<th>#</th>
          		<th>Name</th>
          		<th>Email</th>
          		<th># of Orders</th>
          		<th>Actions</th>
        	</tr>
      	</thead>
      	<tbody id="customers-table-list">
        	@include( 'customers.blocks.list' )
      	</tbody>
    </table>
    <div class="pull-right paginate-container">
        {!! $customers->render() !!}    
    </div>
@endsection

@section( 'modals' )
    @include( 'customers.modals.delete' )
@stop

@section( 'page-level-scripts' )
	<script type="text/javascript" src="/js/views/customers.list.js"></script>
@endsection