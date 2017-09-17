<?php

namespace App\Listeners\Star;

use App\Events\Star\StarsUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Video;


class SendNotifications implements ShouldQueue
{

    public $queue = 'idle';

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
     * @param  StarsUpdated  $event
     * @return void
     */
    public function handle(StarsUpdated $event)
    {
        //
        $video = Video::find($event->video->id);

        echo "[SendNotifications] triggered for ".$video->youtube_id."\n";
    }
}
