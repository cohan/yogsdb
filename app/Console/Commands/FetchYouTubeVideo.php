<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Video;
use App\Channel;

use YouTube;
use Storage;

use App\Events\Video\VideoUpdated;

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

		//
		$video_id = $this->argument('videoid');

		$this->logit($video_id, "Importing video ".$video_id);

		$video = Video::firstOrNew(['youtube_id' => $video_id]);

		if ($latestOnly && !empty($video->title)) {
			$this->logit($video_id, "Abort. We've got the latest flag and we already have ".$video_id);
			return;
		}
		
		$this->logit($video_id, "Fetching data from YouTube API");

		$parts = [
		'id',
		'snippet',
		'contentDetails',
		'statistics',
		'status',
		];

		$youtubeVideo = YouTube::getVideoInfo($video_id, $parts);

		if (empty($youtubeVideo)) {
			if (!empty($video->title)) {
				$this->logit($video_id, "Couldn't get anything for ".$video->title.". It was probably a stream announcement vid. Deleting.");

				$video->delete();
			}
			else {
				$this->logit($video_id, "Couldn't get anything for ".$video_id.". It was probably a stream announcement vid that just vanished.");	
			}

			exit;

		}

		$video->youtube_id = $youtubeVideo->id;
		$video->title = $youtubeVideo->snippet->title;
		$video->description = $youtubeVideo->snippet->description;
		$video->upload_date = date("Y-m-d H:i:s", strtotime($youtubeVideo->snippet->publishedAt));

		// Stats
		$video->duration = $this->getDurationSeconds($youtubeVideo->contentDetails->duration) ?: 0;
		$video->view_count = $youtubeVideo->statistics->viewCount ?: 0;
		$video->like_count = $youtubeVideo->statistics->likeCount ?: 0;
		$video->dislike_count = $youtubeVideo->statistics->dislikeCount ?: 0;

                if (empty($youtubeVideo->statistics->commentCount)) {
			$video->comment_count = 0;
                }
                else {
			$video->comment_count = $youtubeVideo->statistics->commentCount ?: 0;
                }

		$this->logit($video_id, "Title: ".$video->title);
		$this->logit($video_id, "Uploaded: ".$video->upload_date);

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

		$this->logit($video_id, "Thumbnail: https://cdn.yogsdb.com/".$video->youtube_id.".jpg");

		if (!empty($youtubeVideo->snippet->channelId)) {
			$channel = Channel::where('youtube_id', '=', $youtubeVideo->snippet->channelId)->first();

			if (empty($channel) && !empty($youtubeVideo->snippet->channelTitle)) {
				$channel = new Channel;

				$channel->title = $youtubeVideo->snippet->channelTitle;
				$channel->youtube_id = $youtubeVideo->snippet->channelId;
				$channel->description = "";
				$channel->slug = str_slug($channel->title);

				$this->logit($video_id, "Created channel for ".$channel->title);

				$channel->save();
			}


			$video->channel_id = $channel->id;
			$this->logit($video_id, "Attached video to channel");
		}

		$video->slug = str_slug($video->title);

		$video->updated_at = \Carbon\Carbon::now();

		$video->save();

		$this->logit($video_id, "Video Imported");

		echo "\n";

		// event(new VideoUpdated($video));

		$rand = rand(1,3);
		$this->logit($video_id, "Pausing a moment (${rand}s)");
		sleep($rand);
	}

	function getDurationSeconds($duration){
		preg_match_all('/[0-9]+[HMS]/',$duration,$matches);
		$duration=0;
		foreach($matches as $match){
	        //echo '<br> ========= <br>';       
	        //print_r($match);      
			foreach($match as $portion){        
				$unite=substr($portion,strlen($portion)-1);
				switch($unite){
					case 'H':{  
						$duration +=    substr($portion,0,strlen($portion)-1)*60*60;            
					}break;             
					case 'M':{                  
						$duration +=substr($portion,0,strlen($portion)-1)*60;           
					}break;             
					case 'S':{                  
						$duration +=    substr($portion,0,strlen($portion)-1);          
					}break;
				}
			}
	    //  echo '<br> duratrion : '.$duration;
	    //echo '<br> ========= <br>';
		}
		return $duration;

	}

	public function logit($id, $message = "") {
		echo "[".$id."] ".$message."\n";
	}
}
