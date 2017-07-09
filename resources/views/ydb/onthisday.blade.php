@extends('ydb.master')

@section('content')

<div class="col-sm-9 post_page_uploads">

	@foreach ($years as $year)

	@if (!empty($videos[$year][0]))

	<div class='row'>

		<h2 style='font-weight:bold;'>On this day in {{ $year }}</h2>

		<div class="row">
			@foreach($videos[$year] as $video)
			@include('ydb.snippet.video', ['video', $video])
			@endforeach
		</div>

	</div>

	@endif

	@endforeach

</div>

@endsection

