@extends('ydb.master')

@section('content')
<div class="col-sm-9 post_page_uploads">
	<div class="row">

        {{ $videos->count() }}

		@foreach($videos as $video)
			@include('ydb.snippet.video', ['video', $video])
		@endforeach

	</div>
	<div class="row pagination_row">
		{{ $videos->links() }}
	</div>
</div>
@endsection