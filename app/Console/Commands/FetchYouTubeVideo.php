<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Video;
use App\Channel;

use Storage;

use App\Service\YT;

use App\Events\Video\VideoUpdated;

use App\Jobs\AddOrUpdateVideo;

class FetchYouTubeVideo extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'video:import {videoid : The YouTube ID of this video} {--l|latest : Only check the video if we dont already have it}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Import a YouTube video by YouTube Video ID';

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
		$latestOnly = $this->option('latest');
		$video_id = $this->argument('videoid');

		dispatch((new AddOrUpdateVideo($video_id, $latestOnly)));
	}
}
