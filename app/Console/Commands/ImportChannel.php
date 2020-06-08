<?php

namespace App\Console\Commands;

use App\Channel;
use Illuminate\Console\Command;

class ImportChannel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:channel {channelID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports a supported channel ID. All of it. All videos from. Be careful. YouTube only for now.';

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
        $channel = Channel::firstOrCreate(
            [
                'source' => 'youtube',
                'source_id' => $this->argument('channelID')
            ]
        );

        $channel->updateFromSource();

        // Then proceeed to add all the videos.
        // $videos = ...
    }
}
