@extends('ydb.master')

@section('content')
<div class="col-sm-9 post_page_uploads">
	<div class="row">
		@foreach($videos as $video)
		<article class="col-sm-4 video_post postType2">
			<div class="inner row m0">
			<a href="/{{ $video->channel->slug }}/{{ $video->slug }}">
					<div class="row screencast m0">
						<img src="//cdn.yogsdb.com/{{ $video->youtube_id }}.jpg" alt="" class="cast img-responsive">
					</div>
				</a>
				<div class="row m0 post_data">
					<div class="row m0"><a href="/{{ $video->channel->slug }}/{{ $video->slug }}" class="post_title">{{ str_pad_html($video->title,48,"&nbsp; ") }}</a></div>
					<div class="row m0" style='bottom:0px;position:relative;'>
						<div class="fleft author"><a href="/{{ $video->channel->slug }}">{{ str_limit($video->channel->title, 25) }}</a></div>
						<div class="fright date">
							{{ \Carbon\Carbon::createFromTimeStamp(strtotime($video->upload_date))->diffForHumans() }}
						</div>
					</div>
				</div>
				<div class="row m0 taxonomy">
					<div class="fleft category"><a href="/category"><img src="/images/icons/cat.png" alt="">???</a></div>
					<div class="fright views"><a href="#"><img src="/images/icons/views.png" alt="">???</a></div>
				</div>
			</div>
		</article>
		@endforeach
	</div>

	<div class="row pagination_row">
		{{ $videos->links() }}

	</div>
</div>
@endsection