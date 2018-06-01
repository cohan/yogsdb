		<article class="col-sm-4 video_post postType2">
			<div class="inner row m0">
				<a href="/{{ $video->channel->slug }}/{{ $video->slug }}">
					<div class="row screencast m0">
						<img src="//cdn.yogsdb.com/{{ $video->youtube_id }}.jpg" alt="" class="cast img-responsive">
						<div class="media-length">{{ preg_replace("/^00:/i", "", date("H:i:s", $video->duration)) }}</div>
						@hasanyrole('admin|moderator')
						<a href="/video/{{ $video->id }}/edit" class="video-edit btn btn-xs btn-primary">Edit</a>
						@endrole
					</div>
				</a>
				<div class="row m0 post_data">
					<div class="row m0"><a href="/{{ $video->channel->slug }}/{{ $video->slug }}" class="post_title">{!! str_pad_html(str_limit($video->title,55),48,"&nbsp; ") !!}</a></div>
					<div class="row m0" style='bottom:0px;position:relative;'>
						<div class="fleft author"><a href="/{{ $video->channel->slug }}">{{ str_limit(str_ireplace("yogscast ", "", $video->channel->title), 18) }}</a></div>
						<div class="fright date">
							@if ( (time() - strtotime($video->upload_date)) > 604800 )
							<span title='{{ $video->upload_date }}'>
								~{{ \Carbon\Carbon::createFromTimeStamp((strtotime($video->upload_date) - 86400))->diffForHumans() }}
							</span>
							@else
							<span title='{{ $video->upload_date }}'>
								{{ \Carbon\Carbon::createFromTimeStamp(strtotime($video->upload_date))->diffForHumans() }}
							</span>
							@endif
						</div>
					</div>
				</div>
				<div class="row m0 taxonomy">
					<div class="fleft category"><a href="/game/{{ $video->game->slug }}"><i class='fa fa-gamepad'></i> {{ str_limit($video->game->title,15) }}</a></div>
					<div class="fright views"><a href="/{{ $video->channel->slug }}/{{ $video->slug }}"><i class='fa fa-eye'></i> {{ comp_numb($video->view_count) }}</a></div>
				</div>
			</div>
		</article>
