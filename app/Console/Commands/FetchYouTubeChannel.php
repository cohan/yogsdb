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
	protected $signature = 'video:import:channel {channelid : YouTube channel ID} {--l|latest : Only fetch latest videos}';

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
		$latestOnly = $this->option('latest');

		$resultsPerPage = empty($latestOnly) ? $resultsPerPage = 50 : $resultsPerPage = 5;

		$channel_id = $this->argument('channelid');

		$howManyWeAreLoading = empty($latestOnly) ? "all" : "latest";

		$this->logit($channel_id, "Loading $howManyWeAreLoading videos from channel");

		//
		$params = array(
			'channelId'  	=> $channel_id,
			'type'          => 'video',
			'part'          => 'id, snippet',
			'maxResults'    => $resultsPerPage,
			'order'			=> 'date',
		);

		$pageTokens = array();
		$i = 0;
		$search = YouTube::paginateResults($params, null);

		while (true) {
			$this->logit($channel_id, "Retrieved page $i of videos");

			if (empty($search['info']['nextPageToken']) || empty($search['results'])) {
				$this->logit($channel_id, "That's the lot. Breaking out of this loop!");
				break;
			}
			$pageTokens[] = $search['info']['nextPageToken'];

			// $this->logit($channel_id, "Page tokens ".implode(" ", $pageTokens));

			foreach ($search['results'] as $video) {
				$this->logit($channel_id, "Queueing ".$video->id->videoId." for import");

				Artisan::queue('video:import', [
					'videoid' => $video->id->videoId
					]);
			}

			if (!empty($latestOnly)) { break; }

			$rand = rand(1,5);
			$this->logit($channel_id, "Pausing a moment (${rand}s)");
			sleep($rand);
			$search = YouTube::paginateResults($params, $pageTokens[$i]);
			$i++;
		}
	}

	public function logit($id, $message = "") {
		echo "[".$id."] ".$message."\n";
	}
}
