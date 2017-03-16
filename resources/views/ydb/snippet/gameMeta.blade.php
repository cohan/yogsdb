@if ($game->thumbnail)
<div class='col-sm-12'>
	<div class="col-sm-4 section_row author_section widget">
		<div class="media">
			<div class="media-left"><a href="/{{ $game->slug }}"><img src="https://image.icnerd.net/unsafe/250x150/smart/{{ $game->thumbnail }}" alt=""></a></div>
		</div>
	</div>
	<div class='col-sm-8'>
		<a href="/{{ $game->slug }}"><h5>{{ $game->title }}</h5></a>

		@markdown($game->description)
	</div>

	<div class='clearfix'></div>
</div>
@endif
