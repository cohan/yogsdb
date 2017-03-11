@extends('ydb.master')

@section('content')
<div class="col-sm-9">
	<div class="row">
		<article class="col-sm-12 alert alert-danger">
			404 - That's a page not found
		</article>

		<style>
			.embed-container {
				position: relative;
				padding-bottom: 56.25%;
				height: 0;
				overflow: hidden;
				max-width: 100%;
			}
			.embed-container iframe,
			.embed-container object,
			.embed-container embed {
				position: absolute; 
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
			}
		</style>

		<div class='embed-container col-sm-12 alert alert-danger'>
			<iframe src='https://www.youtube.com/embed/qOVLUiha1B8' frameborder='0' allowfullscreen></iframe>
		</div>

	</div>
</div> 
@endsection