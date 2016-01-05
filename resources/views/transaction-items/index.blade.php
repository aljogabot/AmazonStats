@extends( 'layout' )
@section( 'content' )
	<div class="row">
        <div class="col-md-5">
            <h1>Transaction Items</h1>
        </div>
        <div class="col-md-2 pull-right" style="padding-top:20px;">
            <button class="btn btn-primary add-transaction-item">Add Transaction Item</button>
        </div>
		<div class="col-md-5 pull-right">
			<form name="search-form" id="search-form">
				<div class="form-group">
                  	<label class="control-label" for="search" class="sr-only"></label>
                  	<input class="form-control" id="search" type="text" value="" placeholder="Search for Transaction Items" />
                </div>
			</form>
		</div>
	</div>
    <div class="pull-right paginate-container">
        {!! $transactionItems->render() !!}
    </div>
	<table class="table table-bordered">
  		<thead>
        	<tr>
          		<th>#</th>
          		<th>Transaction ID</th>
                <th>Customer Name</th>
          		<th>Product Name</th>
          		<th>Quantity</th>
                <th>Payout</th>
                <th>Actions</th>
        	</tr>
      	</thead>
      	<tbody id="transaction-items-table-list">
        	@include( 'transaction-items.blocks.list' )
      	</tbody>
    </table>
    <div class="pull-right paginate-container">
        {!! $transactionItems->render() !!}
    </div>
@endsection

@section( 'modals' )
    @include( 'transaction-items.modals.delete' )
@stop

@section( 'page-level-scripts' )
	<script type="text/javascript" src="/js/views/transaction-items.list.js"></script>
@endsection