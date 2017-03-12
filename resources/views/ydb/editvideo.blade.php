@extends('ydb.master')

@section('content')
{!! Form::open(['url' => '/video/'.$video->id, 'method' => 'put']) !!}
<div class="col-sm-9 post_page_uploads">
	<div class="row">
		<div class="author_details post_details row m0">
			<div class="embed-responsive embed-responsive-16by9">
				<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $video->youtube_id }}"></iframe>
			</div>
			<div class="row post_title_n_view">
				<h2 class="col-sm-12 post_title">{{ $video->title }}</h2>
			</div>
			<div class="media bio_section">
				<div class="media-left about_social">
					<div class="row m0 section_row author_section widget widget_recommended_to_follow">
						<div class="media">
							<div class="media-left"><a href="page-author.html"><img src="//cdn.yogsdb.com/channel/{{ $video->channel->youtube_id }}.jpg" alt="" class="circle"></a></div>
							<div class="media-body media-middle">
								<a href="page-author.html"><h5>{{ $video->channel->title }}</h5></a>
								<div class="btn-group">
									<a href="#" class="btn follower_count">???</a>
									<a target="_blank" href="https://www.youtube.com/channel/{{ $video->channel->youtube_id }}?sub_confirmation=1" class="btn follow">follow</a>
								</div>
							</div>
						</div>                                    
					</div>
<!-- 					<div class="row m0 social_section section_row">
						<h5>Social Accounts</h5>
						<ul class="list-inline">
							<li><a href="#"><img src="images/icons/social/1.jpg" alt=""></a></li>
							<li><a href="#"><img src="images/icons/social/2.jpg" alt=""></a></li>
							<li><a href="#"><img src="images/icons/social/3.jpg" alt=""></a></li>
							<li><a href="#"><img src="images/icons/social/4.jpg" alt=""></a></li>
							<li><a href="#"><img src="images/icons/social/5.jpg" alt=""></a></li>
							<li><a href="#"><img src="images/icons/social/6.jpg" alt=""></a></li>
							<li><a href="#"><img src="images/icons/social/7.jpg" alt=""></a></li>
							<li><a href="#"><img src="images/icons/social/8.jpg" alt=""></a></li>
							<li><a href="#"><img src="images/icons/social/9.jpg" alt=""></a></li>
							<li><a href="#"><img src="images/icons/social/10.jpg" alt=""></a></li>
							<li><a href="#"><img src="images/icons/social/11.jpg" alt=""></a></li>
							<li><a href="#"><img src="images/icons/social/12.jpg" alt=""></a></li>
						</ul>
					</div> -->
					<div class="row m0 about_section section_row single_video_info">
						<dl class="dl-horizontal">
							<dt>Publish Date:</dt>
							<dd>{{ date("Y-m-d", strtotime($video->upload_date)) }}</dd>

							<dt>Starring</dt>
							<dd>
								<div class='starring'>
									@foreach($video->stars as $star)
									<div class='star'>
										<a href='/{{ $star->channel->slug }}'>
											<img src='//cdn.yogsdb.com/channel/{{ $star->youtube_id }}.jpg' />
											{{ $star->title }}
										</a>
									</div>
									@endforeach
								</div>
							</dd>

							<dt>Series</dt>
							<dd>
								<div class='series'>
									@foreach($video->series as $series)
									<div class='series-inner'>
										<a href='/series/{{ str_slug($series->title) }}'>
											<img src='//cdn.yogsdb.com/{{ $series->videos->first()->youtube_id }}.jpg' title="{{ $series->title }}" alt="{{ $series->title }}" />
										</a>
									</div>
									@endforeach
								</div>
							</dd>

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
						</dl>
					</div>
				</div>
				<div class="media-body author_desc_by_author">
					{!! nl2br($video->description) !!}
				</div>
				@hasanyrole(['admin', 'moderator'])
				<div class="btn-group pull-right" role="group" aria-label="...">
					<input type='submit' type="button" class="btn btn-primary" value='Save' />
					<a href='javascript:history.go(-1);' type="button" class="btn btn-danger">Cancel</a>
				</div>
				@endrole
			</div>
		</div>
	</div>
</div>
</form>
@endsection