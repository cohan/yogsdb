<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Video;

use YouTube;
use Storage;

class FetchYouTubeVideo extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'video:import {videoid : The YouTube ID of this video}';

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
		//
		$video_id = $this->argument('videoid');

		$this->logit($video_id, "Video Imported");

		$video = Video::firstOrNew(['youtube_id' => $video_id]);

		$this->logit($video_id, "Fetching data from YouTube API");


		$youtubeVideo = YouTube::getVideoInfo($video_id);

		$video->youtube_id = $youtubeVideo->id;
		$video->title = $youtubeVideo->snippet->title;
		$video->description = $youtubeVideo->snippet->description;

		$this->logit($video_id, "Title: ".$video->title);


		if (empty($youtubeVideo->snippet->thumbnails->maxres->url)) {
			$thumbnailUrl = $youtubeVideo->snippet->thumbnails->high->url;
		}
		else {
			$thumbnailUrl = $youtubeVideo->snippet->thumbnails->maxres->url;
		}

		if (empty($thumbnailUrl)) {
			$video->thumbnail = null;
		}
		else {
			$youtubeThumbnail = file_get_contents($thumbnailUrl);
			Storage::put($video->youtube_id.'.jpg', $youtubeThumbnail);
			$video->thumbnail = Storage::url($video->youtube_id.'.jpg');
		}

		$this->logit($video_id, "Thumbnail: ".$video->thumbnail);

		$video->save();

		$this->logit($video_id, "Video Imported");

		echo "\n";
	}

	public function logit($video_id, $message = "") {
		echo "[".$video_id."] ".$message."\n";
	}
}
