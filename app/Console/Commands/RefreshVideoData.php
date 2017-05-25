<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Video;
use Artisan;

class RefreshVideoData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'video:refresh {--all : Refresh every video (probs dont do this)} {{--count= : How many to refresh }}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh videos that havent been updated in a while';

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
        $refreshAll = $this->option('all');
        $count = $this->option('count') ?: 10;

        if ($refreshAll) {
            $videos = Video::orderBy("upload_date", "desc")->get();
        }
        else {
            $videos = Video::where("updated_at", "<", date("Y-m-d H:i:s", strtotime("1 week ago")))->orderBy("updated_at", "asc")->limit($count)->get();            
        }

        foreach ($videos as $video) {

            echo "Refresh due for ".$video->title." last updated ".$video->updated_at."\n";

            Artisan::queue('video:import', [
                'videoid' => $video->youtube_id,
                ]);

        }
    }
}
