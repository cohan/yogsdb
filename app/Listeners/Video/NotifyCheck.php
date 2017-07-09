<?php

namespace App\Listeners\Video;

use App\Events\Video\MetaDataUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyCheck implements ShouldQueue
{

    public $queue = 'high';

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
     * @param  MetaDataUpdated  $event
     * @return void
     */
    public function handle(MetaDataUpdated $event)
    {
        //
        echo "[NotifyHandler] Checking to see if we need to notify anyone about ".$event->video->title."\n";
    }
}
