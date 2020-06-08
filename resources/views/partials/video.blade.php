<div class='video {{ $video->source }} col-12 col-md-3 float-left'>
    <a href='{{ route('videos.show', $video) }}'>
        <img class='img-fluid' src='{{ $video->image }}' />
        <div class='video-title text-center pt-1'>{{ $video->title }}</div>
    </a>

    @if ($video->source == "youtube")

    <div class='mt-1'>
        <pre class='text-center pt-2'>!voteadd {{ $video->source_id }}</pre>
    </div>

    @endif

</div>