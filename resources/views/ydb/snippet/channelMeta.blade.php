<div class='col-sm-12'>
	<div class="col-sm-4 section_row author_section widget widget_recommended_to_follow">
		<div class="media">
			<div class="media-left"><a href="/{{ $channel->slug }}"><img src="//cdn.yogsdb.com/channel/{{ $channel->youtube_id }}.jpg" alt="" class="circle"></a></div>
			<div class="media-body media-middle">
				<a href="/{{ $channel->slug }}"><h5>{{ $channel->title }}</h5></a>
				<div class="btn-group">
					<a href="#" class="btn follower_count">{{ comp_numb($channel->subscriber_count) }}</a>
					<a target="_blank" href="https://www.youtube.com/channel/{{ $channel->youtube_id }}?sub_confirmation=1" class="btn follow">Subscribe</a>
				</div>
			</div>
		</div>
	</div>
	<div class='col-sm-8'>
		@markdown($channel->description)
	</div>

	<div class='clearfix'></div>
</div>