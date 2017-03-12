<?php

namespace App\Listeners\Video;

use App\Events\Video\VideoUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Channel;
use App\Video;

class AutoTag implements ShouldQueue
{

    public $queue = 'low';

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
        $video = Video::where(['id' => $event->video->id])->first();
        $channel = Channel::where(['id' => $event->video->channel->id])
            ->with('stars')
            ->withCount('stars')
            ->first();

        echo $video->title." was updated\n";

        if ($channel->stars_count == 1) {
            echo "Channel only has one Star attached as their primary channel. Attaching\n";
            $video->stars()->attach($channel->stars->pluck('id')->toArray());
        }
        else {
            echo "Can't auto-attach stars, ".$channel->title." there are ".$channel->stars_count." Stars with this channel as their primary channel\n";
        }
    }
}
