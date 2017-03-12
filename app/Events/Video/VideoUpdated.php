<?php

namespace App\Events\Video;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Video;
use App\Channel as YTChannel;

class VideoUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $video;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($video)
    {
        //
        $this->video = Video::where(['id' => $video->id])->first();
        $this->channel = YTChannel::where(['id' => $video->channel->id])->with('stars')->withCount('stars')->first();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
