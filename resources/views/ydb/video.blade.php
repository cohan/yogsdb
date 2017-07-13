@extends('ydb.master')

@section('content')
<div class="col-sm-9 post_page_uploads">
	<div class="row">
		<div class="author_details post_details row m0">
			<div class="embed-responsive embed-responsive-16by9">
				<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $video->youtube_id }}"></iframe>
			</div>
			<div class='linkout-youtubevideo alert alert-danger'>
				<a href='https://youtu.be/{{ $video->youtube_id }}' target='_blank'>Open in YouTube</a>
			</div>

			<style type="text/css">
				.linkout-youtubevideo {
					text-align: center;
				}
				.linkout-youtubevideo a,
				.linkout-youtubevideo a:visited,
				.linkout-youtubevideo a:hover,
				.linkout-youtubevideo a:active {
					color: #111;
				}
			</style>

			<div class="row post_title_n_view">
				<h2 class="col-sm-12 post_title">{{ $video->title }}</h2>
			</div>
			<div class="media bio_section">
				<div class="media-left about_social">
					<div class="row m0 section_row author_section widget widget_recommended_to_follow">
						<div class="media">
							<div class="media-left"><a href="/{{ $video->channel->slug }}"><img src="//cdn.yogsdb.com/channel/{{ $video->channel->youtube_id }}.jpg" alt="" class="circle"></a></div>
							<div class="media-body media-middle">
								<a href="/{{ $video->channel->slug }}"><h5>{{ $video->channel->title }}</h5></a>
								<div class="btn-group">
									<a href="#" class="btn follower_count">{{ comp_numb($video->channel->subscriber_count) }}</a>
									<a target="_blank" href="https://www.youtube.com/channel/{{ $video->channel->youtube_id }}?sub_confirmation=1" class="btn follow">Subscribe</a>
								</div>
							</div>
						</div>                                    
					</div>
					<div class="row m0 about_section section_row single_video_info">
						<dl class="dl-horizontal">
							<dt>Publish Date:</dt>
							<dd>{{ date("Y-m-d", strtotime($video->upload_date)) }}</dd>

							<dt>Starring</dt>
							<dd>
								<div class='starring'>
									@foreach($video->stars as $star)
									<div class='star'>
										@if (!empty($star->channel->slug))
										<a href='/{{ $star->channel->slug }}'>
											<img src='//cdn.yogsdb.com/channel/{{ $star->youtube_id }}.jpg' />
											{{ $star->title }}
										</a>
										@else
										<a href='#'>
											<img src='/images/unknown.png' />
											{{ $star->title }}
										</a>
										@endif
									</div>
									@endforeach
								</div>
							</dd>
 
<!-- 							<dt>Series</dt>
							<dd>
								<div class='series'>
									@foreach($video->series as $series)
									<div class='series-inner'>
										<a href='/series/{{ $series->slug }}'>
											{{ $series->title }}
										</a>
									</div>
									@endforeach
								</div>
							</dd>
 -->

							<dt>Game</dt>
							<dd>
								<div class='playing-game'>
									<div class='playing-game-inner'>
										<a href='/game/{{ $video->game->slug }}'>
											{{ $video->game->title }}
										</a>
									</div>
								</div>
							</dd>
<!-- 
							<dt>Tagged</dt>
							<dd>
								<div class='tags'>
									@foreach(["test", "yogscast"] as $label)
									<a class='label label-success label-as-badge' href='/tag/{{ str_slug($label) }}'>
										{{ $label }}
									</a>
									@endforeach
								</div>
							</dd>
 -->
						</dl>
						@hasanyrole(['admin', 'moderator'])
						<a href='/video/{{ $video->id }}/edit' class='btn btn-primary'>
							Edit
						</a>
						@endrole
					</div>
				</div>
				<div class="media-body author_desc_by_author">
					@markdown($video->description)
				</div>
			</div>
		</div>
	</div>
</div>
@endsection