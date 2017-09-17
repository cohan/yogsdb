@if ($star->thumbnail)
<div class='col-sm-12'>
	<div class="col-sm-4 section_row author_section widget">
		<div class="media">
			<div class="media-left"><a href="/star/{{ $star->slug }}"><img src="https://image.icnerd.net/unsafe/250x150/smart/{{ $star->thumbnail }}" alt=""></a></div>
		</div>
	</div>
	<div class='col-sm-8'>
		<a href="/{{ $star->slug }}"><h5>{{ $star->title }}</h5></a>

		@markdown($star->description)
	</div>

	<div class='clearfix'></div>
</div>
@endif
