@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class='single-video col-8'>

        @if ($video->source == "youtube")

            <div class='embed-container'>
                <iframe src='https://www.youtube.com/embed/{{ $video->source_id }}' frameborder='0' allowfullscreen></iframe>
            </div>
            <a class='float-right' href='https://youtu.be/{{ $video->source_id }}' target="_blank" rel="noopener">Watch on YouTube</a>

        @elseif ($video->source == "twitch")

            <div class='embed-container'>
                <iframe src='https://player.twitch.tv/?video={{ $video->source_id }}' frameborder='0' allowfullscreen></iframe>
            </div>
            <a class='float-right' href='https://twitch.tv/videos/{{ $video->source_id }}' target="_blank" rel="noopener">Watch on Twitch</a>            

        @endif

    </div>
</div>

@endsection
