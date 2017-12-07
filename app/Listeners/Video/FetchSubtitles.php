<?php

namespace App\Listeners\Video;

use App\Events\Video\VideoUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FetchSubtitles
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
        return;

        //
        $video = $event->video;

        $ytdlBin = env('YOUTUBE_DL', 'scripts/youtube-dl');
        $ytdlParams = " --write-info-json --write-sub --write-auto-sub --skip-download --sub-format srt ";
        $ytdlOutput = " -o ".escapeshellarg("/tmp/%(id)s.%(ext)s");

        $ytdlVid = " https://www.youtube.com/watch?v=".$video->youtube_id." ";

        $cmd = $ytdlBin.$ytdlParams.$ytdlOutput.$ytdlVid;

        exec($cmd);

        $ytdlInfo = "/tmp/".$video->youtube_id.".info.json";
        $ytdlSubs = glob("/tmp/".$video->youtube_id.".en.*");
        $ytdlSubs = $ytdlSubs[0];

        echo "Info in ".$ytdlInfo."\n";
        echo "Subs in ".$ytdlSubs."\n";

    }
}
