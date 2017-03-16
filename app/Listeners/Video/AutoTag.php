<?php

namespace App\Listeners\Video;

use App\Events\Video\VideoUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Channel;
use App\Video;
use App\Game;

use Goutte\Client;

class AutoTag implements ShouldQueue
{

	public $queue = 'low';

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
		$video = Video::where(['id' => $event->video->id])->first();
		$channel = Channel::where(['id' => $event->video->channel->id])
		->with('stars')
		->withCount('stars')
		->first();

		$this->logit("AutoTag", $video->title." was updated");

		$this->attachStars($video,$channel);

		$this->findGame($event->video);

	}

	public function attachStars($video,$channel) {

		if ($channel->stars_count == 1) {
			$this->logit("AutoTag","Channel only has one Star attached as their primary channel. Attaching");

			try {
				$video->stars()->attach($channel->stars->pluck('id')->toArray());
			}
			catch(\Exception $e) {
				$this->logit('AutoLog', "That Star is already attached to this video. Good times.");
			}
		}
		else {
			$this->logit('AutoTag', "Can't auto-attach stars from ".$channel->title." as there are ".$channel->stars_count." Stars with this channel as their primary channel");
		}
	}

	public function findGame($video) {

		if ($video->game_id != 1 && !empty($video->game_id)) {
			$this->logit("GameTagger", "Video already has a Game attached");

			return;	
		}

		$client = new Client();

		$crawler = $client->request('GET', 'https://www.youtube.com/watch?v='.$video->youtube_id."&hl=en");

		$videoMeta = $crawler->filter('ul[class="watch-extras-section"] > li > ul > li > a')->each(function ($node) { return $node->text()."\n"; });

		$videoMeta[0] = trim($videoMeta[0]);

		$unknownCats = [
			'Gaming',
			'YouTube Gaming',
		];

		if (in_array($videoMeta[0], $unknownCats)) {
			$videoMeta[0] = "Unknown";
		}

		if (empty($videoMeta[0])) {
			$this->logit("GameTagger", "Couldn't identify the Game in ".$video->title);

			return;
		}

		$this->logit("GameTagger", "Identified Game as ".$videoMeta[0]);

		try {
			$game = Game::where(['title' => $videoMeta[0]])->firstOrFail();
		}
		catch (\Exception $e) {
			$game = new Game();

			$game->title = $videoMeta[0];
			$game->slug = str_slug($game->title);

			$game->giantbomb_id = "NOGIANTBOMB-".uniqid();

			$game->save();

			$this->logit("GameTagger", "Created new Game ".$game->title);
		}
		$video->game_id = $game->id;

		$video->save();

		$this->logit("GameTagger", "Attached ".$game->title." to ".$video->title);

		// We're being a little harsh on YouTube here as we're not using the API
		// Lets give it a breather

		$rand = rand(3,10);

		$this->logit("GameTagger", "Sleeping for $rand seconds");

		sleep($rand);
	}


	public function logit($id, $message = "") {
		echo "[".$id."] ".$message."\n";
	}
}
