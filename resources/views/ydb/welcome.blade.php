@extends('ydb.master')

@section('content')
<div class="col-sm-9">
    <div class="row">
        <p>
            Looks a bit bare here aye? I've had to delete all the data that hasn't been updated less than 28 days ago so that YouTube will re-enable the API key. Bare with!<br /><br />
            As soon as it's back up I'll get everything updating in line with YT policies.
        </p>
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