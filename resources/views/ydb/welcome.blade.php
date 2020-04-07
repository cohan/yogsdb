@extends('ydb.master')

@section('content')
<div class="col-sm-9">
    <div class="row">
        <p>Aup. I know the videos aren't updating at the moment. YouTube want me to fill out a million forms and jump through a few thousand hoops to get the API access back. I intend on getting round to it, but my free time is a little stretched as it is right now</p>
    </div>
</div>

<div class="col-sm-9 post_page_uploads">
	<div class="row">

		@foreach($videos as $video)
			@include('ydb.snippet.video', ['video', $video])
		@endforeach

	</div>
	<div class="row pagination_row">
		{{ $videos->links() }}
	</div>
</div>
@endsection