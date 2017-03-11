<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Artisan;
use YouTube;
use App\Video;

class FetchYouTubeChannel extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'video:import:channel {channelid : YouTube channel ID}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Import all YouTube videos from a channel';

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
		$channel_id = $this->argument('channelid');

		$this->logit($channel_id, "Loading all videos from channel");

		//
		$params = array(
			'channelId'             => $channel_id,
			'type'          => 'video',
			'part'          => 'id, snippet',
			'maxResults'    => 50
		);

		$pageTokens = array();
		$i = 1;

		while (true) {
			$search = YouTube::paginateResults($params, null);
			$this->logit($channel_id, "Retrieved page $i of videos");

			if (empty($search['info']['nextPageToken'])) {
				$this->logit($channel_id, "That's the lot. Breaking out of this loop!");
				break;
			}
			$pageTokens[] = $search['info']['nextPageToken'];

			foreach ($search['results'] as $video) {
				$this->logit($channel_id, "Queueing ".$video->id->videoId." for import");

				Artisan::queue('video:import', [
					'videoid' => $video->id->videoId
					]);
			}

			$i++;

			$rand = rand(1,60);
			$this->logit($channel_id, "Pausing a moment (${rand}s)");
			sleep($rand);
		}
	}

	public function logit($id, $message = "") {
		echo "[".$id."] ".$message."\n";
	}
}
