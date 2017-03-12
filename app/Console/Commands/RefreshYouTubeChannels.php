<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Channel;
use Artisan;
use YouTube;
use Storage;

class RefreshYouTubeChannels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'channel:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh latest videos for all channels';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //

        $channels = Channel::all();

        foreach ($channels as $channel) {
            $channelMeta = YouTube::getChannelById($channel->youtube_id);

            if (empty($channelMeta->snippet->thumbnails->high->url)) {
                $thumbnailUrl = $channelMeta->snippet->thumbnails->default->url;
            }
            else {
                $thumbnailUrl = $channelMeta->snippet->thumbnails->high->url;
            }

            if (empty($thumbnailUrl)) {
                $channel->thumbnail = null;
            }
            else {
                $youtubeThumbnail = file_get_contents($thumbnailUrl);
                Storage::put("channel/".$channel->youtube_id.'.jpg', $youtubeThumbnail);
                $channel->thumbnail = Storage::url("channel/".$channel->youtube_id.'.jpg');
            }

            $channel->thumbnail = $channel->thumbnail;

            // Statistics update
            $channel->view_count = $channelMeta->statistics->viewCount;
            $channel->comment_count = $channelMeta->statistics->commentCount;
            $channel->subscriber_count = $channelMeta->statistics->subscriberCount;
            $channel->video_count = $channelMeta->statistics->videoCount;

            $channel->save();
            $this->logit("ChannelRefresh", "Updated channel thumbnail for ".$channel->title);

            $this->logit("ChannelRefresh", "Dispatch job to load latest videos for ".$channel->title);

            Artisan::queue('video:import:channel', [
                'channelid' => $channel->youtube_id,
                '--latest' => true,
                ]);
        }
    }

    public function logit($id, $message = "") {
        echo "[".$id."] ".$message."\n";
    }
}
