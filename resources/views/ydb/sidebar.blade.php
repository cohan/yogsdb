				<div class="col-sm-3 sidebar sidebar2">
                    <div class="row m0 sidebar_row_inner streams">
                        <div class="row m0 widget">
                            <h5 class="widget_title">Live on Twitch</h5>
                            <div class="row m0 inner">
                                @foreach (App\Service\Twitch::getLiveStreams()->slice(0, 3)->all() as $stream)

                                <div class='sidebar-channel col-sm-12 stream'>
                                    <a href='{{ $stream->channel->url }}' target="_blank">
                                        <img class='img-responsive' src="{{ $stream->preview->medium }}" />
                                        {{ $stream->channel->display_name }} playing {{ $stream->game }}
                                    </a>
                                    <div class='stream-meta'>
                                        {{ $stream->viewers }} viewers
                                    </div>
                                </div>
                                @endforeach

                                @if (App\Service\Twitch::getLiveStreams()->count() > 3)
                                <div class='sidebar-channel col-sm-12 stream'>
                                    <a href="https://www.twitch.tv/team/yogscast" target="_blank">
                                        View all
                                    </a>
                                    (3 of {{ ( App\Service\Twitch::getLiveStreams()->count() ) }} streams displayed)
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <style type="text/css">
                    .stream, .streams {
                        margin-bottom: 1em;
                    }
                </style>

                <div class="row m0 sidebar_row_inner">
                    <div class="row m0 widget">
                        <h5 class="widget_title">Yogscast Channels</h5>
                        <div class="row m0 inner">
                            @foreach (App\Channel::orderBy('slug', 'asc')->get() as $channel)
                            <div class='sidebar-channel col-sm-12'>
                                <a href='/{{ $channel->slug }}'>
                                    {{ $channel->title }}
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>