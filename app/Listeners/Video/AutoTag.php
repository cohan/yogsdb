<?php

namespace App\Listeners\Video;

use App\Events\Video\VideoUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AutoTag
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  VideoUpdated  $event
     * @return void
     */
    public function handle(VideoUpdated $event)
    {
        $video = $event->video;
        $channel = $event->channel;

        echo $video->title." was updated\n";

        if ($channel->stars_count == 1) {
            $video->stars()->attach($channel->stars->pluck('id')->toArray());
        }
    }
}
