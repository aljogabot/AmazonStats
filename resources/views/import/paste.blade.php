@extends('layout')
@section('content')
	<form name="paste-data-form" method="POST" action="{{ URL::route( 'process-paste-buyer-id' ) }}" accept-charset="UTF-8">
		<div class="row">
			<div class="col-md-5">
	            <h1>Paste Buyer ID</h1>
	        </div>
		</div>
		<br />
		<div class="content">
			<div class="alert form-message alert-info">This is where you can import your data ...</div>

			<div id="progress" class="progress progress-striped">
                <div style="width: 0%" class="progress-bar progress-bar-info"></div>
          	</div>

			<div class="form-group">
	            <label>Paste Text Here</label>
	            <textarea name="buyerIdList" class="form-control" rows="15"></textarea>
	        </div>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Process</button>
	</form>
@endsection('content')
@section( 'page-level-scripts' )
	<script type="text/javascript" src="/js/views/import.data.js"></script>
@endsection