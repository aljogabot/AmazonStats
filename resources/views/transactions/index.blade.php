@extends( 'layout' )
@section( 'content' )
	<div class="row">
        <div class="col-md-5">
            <h1>Transactions</h1>
        </div>
        <div class="col-md-2 pull-right" style="padding-top:20px;">
            <button class="btn btn-primary add-transaction">Add Transaction</button>
        </div>
		<div class="col-md-5 pull-right">
			<form name="search-form" id="search-form">
				<div class="form-group">
                  	<label class="control-label" for="search" class="sr-only"></label>
                  	<input class="form-control" id="search" type="text" value="" placeholder="Search for Transactions" />
                </div>
			</form>
		</div>
	</div>
    <div class="pull-right paginate-container">
        {!! $transactions->render() !!}
    </div>
	<table class="table table-bordered">
  		<thead>
        	<tr>
          		<th>#</th>
          		<th>Customer</th>
          		<th>Amazon Order ID</th>
          		<th>Recipient Email</th>
                <th>Recipient Name</th>
                <th># of Items</th>
          		<th>Actions</th>
        	</tr>
      	</thead>
      	<tbody id="transactions-table-list">
        	@include( 'transactions.blocks.list' )
      	</tbody>
    </table>
    <div class="pull-right paginate-container">
        {!! $transactions->render() !!}
    </div>
@endsection

@section( 'modals' )
    @include( 'transactions.modals.delete' )
@stop

@section( 'page-level-scripts' )
	<script type="text/javascript" src="/js/views/transactions.list.js"></script>
@endsection