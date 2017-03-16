<?php

namespace App\Listeners\Video;

use App\Events\Video\VideoUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Channel;
use App\Video;

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

	public function logit($id, $message = "") {
		echo "[".$id."] ".$message."\n";
	}
}
