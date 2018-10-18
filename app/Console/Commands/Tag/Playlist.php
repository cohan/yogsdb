<?php

namespace App\Console\Commands\Tag;

use Illuminate\Console\Command;

use YouTube;
use App\Video;
use App\Star;
use App\Series;

use Artisan;

class Playlist extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = '
	tag:playlist
	{playlist : YouTube playlist ID (not url) }
    {--star=* : Tag the star slug in this playlist }
    {--unstar=* : Untag the star slug in this playlist }
	{--series= : Tag the series slug to be applied to this playlist }
	{--game= : Tag the game slug played in this playlist }

	';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Go through all videos in a YouTube playlist and tag the videos here';

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
		$playlist_id = $this->argument('playlist');

        $stars = $this->option('star') ?: null;
        $unstars = $this->option('unstar') ?: null;
		$series = $this->option('series') ?: null;
		$game = $this->option('game') ?: null;

		if (!empty($series)) {
			$series = Series::where(['slug' => $series])->first();

			if (empty($series)) {
				echo "Couldn't find that series. Double check the slug there fella\n";
			}
			else {
				echo "Attaching series ".$series->title."\n";
			}
		}

		$pageToken = '';
		while (true) {

			$playlistItems = Youtube::getPlaylistItemsByPlaylistId(
				$playlist_id,
				$pageToken,
				50,
				['id', 'snippet']
				);

			foreach ($playlistItems['results'] as $playlistVideo) {
				$video_id = $playlistVideo->snippet->resourceId->videoId;

				$video = Video::where(['youtube_id' => $video_id])->first();

				if (empty($video->title)) {
					// Import video?
					echo "Wait what is ".$video_id." I dont know that one. Importing.\n";


					$artisanParams = [
					'videoid' => $video_id
					];

					Artisan::call('video:import', $artisanParams);

					continue;

					$video = Video::where(['youtube_id' => $video_id])->first();

				}


				echo "Operating on ".$video->title."\n";

                if (!empty($stars)) {
                    foreach ($stars as $star) {
                        $star = Star::where('title', 'like', $star)->first();

                        echo "Attaching ".$star->title." to ".$video->title."\n";

                        try {
                            $video->stars()->attach([$star->id]);
                        }
                        catch (\Exception $e) {
                            echo "Already attached\n";
                        }
                    }
                }

                if (!empty($unstars)) {
                    foreach ($unstars as $unstar) {
                        $unstar = Star::where('title', 'like', $unstar)->first();

                        echo "Detaching ".$unstar->title." from ".$video->title."\n";

                        try {
                            $video->stars()->detach([$unstar->id]);
                        }
                        catch (\Exception $e) {
                            echo "Already detached\n";
                        }
                    }
                }

				if (!empty($series)) {
					echo "Attach series ".$series->title." to ".$video->title."\n";

					try {
						$video->series()->attach($series->id);
					}
					catch (\Exception $e) {
						echo "Already attached\n";
					}
				}

			}

			//var_dump($playlistItems);

			if (empty($playlistItems['info']['nextPageToken'])) {
				break;
			}
			else {
				$pageToken = $playlistItems['info']['nextPageToken'];
			}
		}
	}
}
