<?php

namespace App\Console\Commands;

use App\Video;
use Illuminate\Console\Command;

class ImportVideo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:video {videoID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports the specified video. YouTube IDs only for now.';

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
    public function handle(): void
    {
        Video::firstOrCreate(
            [
                'source' => 'youtube',
                'source_id' => $this->argument('videoID')
            ]
        );
    }
}
