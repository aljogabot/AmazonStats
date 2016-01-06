@extends('layout')
@section('content')
	<form name="import-data-form" method="POST" action="{{ URL::route( 'import-process' ) }}" accept-charset="UTF-8" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-5">
	            <h1>Import Data</h1>
	        </div>
		</div>
		<br />
		<div class="content">
			<div class="alert form-message alert-info">This is where you can import your data ...</div>

			<div class="form-group">
	            <label for="faq_file">Upload File</label>
	            <input type="text" id="file_label" name="file_label" class="form-control" placeholder="Please upload your file in ( .txt | .csv )" readonly required autofocus>        
	            <div class="file-upload btnupl btnupl-primary"><span>Upload</span>
	                <input class="upload" type="file" id="upload" name="file">
	            </div>
	        </div>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Process</button>
	</form>
@endsection('content')
@section( 'page-level-scripts' )
	<script type="text/javascript" src="/js/views/import.data.js"></script>
@endsection