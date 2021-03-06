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
	protected $signature = 'video:import:channel {channelid : YouTube channel ID} {--l|latest : Only fetch latest videos} {--m|missed : Import with the latest flag but still fetch all videos } {--before= : Limit to videos before date (1970-01-01T00:00:00Z) } {--after= : Limit to videos posted after date (1970-01-01T00:00:00Z) }';

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
		$missedToo = $this->option('missed');
		$beforeDate = $this->option('before');
		$afterDate = $this->option('after');


		$resultsPerPage = empty($latestOnly) ? $resultsPerPage = 50 : $resultsPerPage = 30;

		$channel_id = $this->argument('channelid');

		$howManyWeAreLoading = empty($latestOnly) ? "all" : "latest";

		$this->logit($channel_id, "Loading $howManyWeAreLoading videos from channel");

		//
		$params = array(
			'channelId'  	=> $channel_id,
			'type'          => 'video',
			'part'          => 'id, snippet',
			'maxResults'    => $resultsPerPage,
			'order'			=> 'date'
			);

		if ($beforeDate) {
			$params['publishedBefore'] = date("c", strtotime($beforeDate));
		}
		if ($afterDate) {
			$params['publishedAfter'] = date("c", strtotime($afterDate));
		}

		$pageTokens = array();
		$i = 0;
		$search = YouTube::paginateResults($params, null);

		while (true) {
			$this->logit($channel_id, "Retrieved page $i of videos");

			if (empty($search['results'])) {
				$this->logit($channel_id, "That's the lot. Breaking out of this loop!");
				break;
			}

			foreach ($search['results'] as $video) {
				$this->logit($channel_id, "Queueing ".$video->id->videoId." for import");

				$artisanParams = [
					'videoid' => $video->id->videoId
				];

				if ($latestOnly) {
					$artisanParams['--latest'] = true;
				}

				Artisan::queue('video:import', $artisanParams);
			}

			if (empty($search['info']['nextPageToken'])) {
				$this->logit($channel_id, "That's the lot. Breaking out of this loop!");
				break;
			}
			$pageTokens[] = $search['info']['nextPageToken'];

			if ($latestOnly && !$missedToo) { break; }

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
