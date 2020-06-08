@extends('ydb.master')

@section('content')
<div class="col-sm-9">
    <div class="row">
        <p>I've got the details on what's needed YouTube-wise, but I've decided it's about time to rewrite this beast OSS. Join in if you fancy: <a href='https://github.com/cohan/yogsdb' target="_blank" rel='noopener'>https://github.com/cohan/yogsdb</a></p>
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