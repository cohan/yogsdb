@extends('ydb.master')

@section('content')
<div class="col-sm-9 post_page_uploads">
	<div class="row">

		@foreach($videos as $video)
		<article class="col-sm-4 video_post postType2">
			<div class="inner row m0">
				<a href="/single-video"><div class="row screencast m0">
					<img src="//cdn.yogsdb.com/{{ $video->youtube_id }}.jpg" alt="" class="cast img-responsive">
<!-- 					<div class="play_btn"></div>
					<div class="media-length">17:30</div> -->
				</div></a>
				<div class="row m0 post_data">
				<div class="row m0"><a href="/{{ $video->channel->slug }}/{{ $video->slug }}" class="post_title">{{ str_pad_html($video->title,48,"&nbsp; ") }}</a></div>
					<div class="row m0" style='bottom:0px;position:relative;'>
						<div class="fleft author"><a href="/{{ $video->channel->slug }}">{{ str_limit($video->channel->title, 25) }}</a></div>
						<div class="fright date">{{ date("Y/m/d", strtotime($video->upload_date)) }}</div>
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
<!-- 		<ul class="pagination">
			<li><a href="#">previous</a></li>
			<li class="active"><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#">4</a></li>
			<li class="disabled"><a href="#">...</a></li>
			<li><a href="#">next</a></li>
		</ul> -->
	</div>
</div>
@endsection