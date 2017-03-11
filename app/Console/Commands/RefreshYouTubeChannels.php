<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Channel;
use Artisan;

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
