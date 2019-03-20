<?php

namespace App\Listeners\Video;

use App\Channel;
use App\Events\Video\VideoUpdated;
use App\Game;
use App\Jobs\PatternTagStars;
use App\Service\YT;
use App\Star;
use App\Video;
use Goutte\Client;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AutoTag implements ShouldQueue
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
		$video = Video::where(['id' => $event->video->id])->first();
		$channel = Channel::where(['id' => $event->video->channel->id])
		->with('stars')
		->withCount('stars')
		->first();

		$this->logit("AutoTag", $video->title." was updated");

		$this->attachChannelStars($video,$channel);

		$this->findStars($video);

		$this->findGame($event->video);

	}

	public function attachChannelStars($video,$channel) {

		if ($channel->stars_count == 1) {
			$this->logit("AutoTag","Channel only has one Star attached as their primary channel. Attaching");

			try {
				$video->stars()->attach($channel->stars->pluck('id')->toArray());
			}
			catch(\Exception $e) {
				return;
			}
		}
		else {
			$this->logit('AutoTag', "Can't auto-attach stars from ".$channel->title." as there are ".$channel->stars_count." Stars with this channel as their primary channel");
		}

		$this->logit('AutoTag', 'Queueing Pattern Tagger');

		dispatch((new PatternTagStars($video)));


	}

	public function findGame($video) {

		if ($video->game_id != 1 && !empty($video->game_id)) {
			$this->logit("GameTagger", "Video already has a Game attached");

			return;	
		}

        $foundGame = YT::getVideoGame($video->youtube_id);

		$this->logit("GameTagger", "Identified Game as ".$foundGame);

		try {
			$game = Game::where(['title' => $foundGame])->firstOrFail();
		}
		catch (\Exception $e) {
			$game = new Game();

			$game->title = $foundGame;
			$game->slug = str_slug($game->title);

			$game->giantbomb_id = "NOGIANTBOMB-".uniqid();

			$game->save();

			$this->logit("GameTagger", "Created new Game ".$game->title);
		}
		$video->game_id = $game->id;

		$video->save();

		$this->logit("GameTagger", "Attached ".$game->title." to ".$video->title." on ".$video->channel->title);

		// We're being a little harsh on YouTube here as we're not using the API
		// Lets give it a breather

		$rand = rand(3,10);

		$this->logit("GameTagger", "Sleeping for $rand seconds");

		sleep($rand);
	}

	public function findStars($video) {

		////
		//// Definitely needs more work :(
		////

		// $stars = Star::all();

		// $tooPopular = ["Simon"];

		// $tooNoisy = ["Yogscast Live"];

		// foreach ($stars as $star) {

		// 	if (in_array($star->title, $tooPopular)) {
		// 		// $this->logit("StarTagger", "Can't tag ".$star->title." on ".$video->channel->title." as they're mentioned frequently even when they're not in videos");
		// 		continue;
		// 	}
		// 	if (in_array($video->channel->title, $tooNoisy)) {
		// 		// $this->logit("StarTagger", "Can't tag ".$star->title." because ".$video->channel->title." lists people even not in videos");
		// 		continue;
		// 	}

		// 	if (strpos($video->description, "&list=") !== false) {
		// 		$this->logit("StarTagger", "Description contains a playlist URL. Playing it safe and bailing out");
		// 		break;
		// 	}

		// 	$search = '/\b' . preg_quote($star->title) . '\b/i';
		// 	if (preg_match($search, $video->description) === 1)
		// 	{
		// 		$this->logit("StarTagger", "Found ".$star->title." in the description of ".$video->title);

		// 		try {
		// 			$video->stars()->attach([$star->id]);
		// 		}
		// 		catch(\Exception $e) {
		// 			continue;
		// 		}
		// 	}

		// 	$search = '/\b' . preg_quote($star->title) . '\b/i';
		// 	if (preg_match($search, $video->title) === 1)
		// 	{
		// 		$this->logit("StarTagger", "Found ".$star->title." in the title of ".$video->title);

		// 		try {
		// 			$video->stars()->attach([$star->id]);
		// 		}
		// 		catch(\Exception $e) {
		// 			continue;
		// 		}
		// 	}
		// }
	}


	public function logit($id, $message = "") {
		echo "[".$id."] ".$message."\n";
	}
}
