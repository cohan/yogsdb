<?php

namespace App\Service;

use Storage;
use Youtube;

use App\Video;
use App\Channel;

use App\Events\Video\VideoUpdated;
use App\Jobs\PatternTagStars;
use \Done\Subtitles\Subtitles;

use GuzzleHttp\Client;

class YT {

	public static function getVideo($id) {
		$parts = [
			'id',
			'snippet',
			'contentDetails',
			'statistics',
			'status',
		];

		$youtubeVideo = Youtube::getVideoInfo($id, $parts) ?? false;

		// TODO: Make this a better exception
		if (!$youtubeVideo) {
			if (Video::where(['youtube_id' => $id])->withTrashed()->exists()) {
				Video::where(['youtube_id' => $id])->delete();
			}

			throw new \Exception("YouTube says that video doesn't exist. Removed from our DB.");
		}
		else { return $youtubeVideo; }
	}

	public static function addOrUpdateVideo($id, $latestOnly = null) {
		$youtubeVideo = self::getVideo($id);

		if ($latestOnly === true && Video::where(['youtube_id' => $id])->withTrashed()->exists()) {
			logger()->info("Update with latest flag for ".$id." but we already have it. Only updating tags.");

			$video = Video::where(['youtube_id' => $id])->withTrashed()->first();

			if ($video->trashed()) {
				$video->restore();
			}

			dispatch((new PatternTagStars($video))->onQueue('low'));

			return;
		}

		logger()->info("Updating or adding ".$id);

		if (Video::where(['youtube_id' => $id])->withTrashed()->exists()) {
			$video = Video::where(['youtube_id' => $id])->withTrashed()->first();
			if ($video->trashed()) {
				$video->restore();
			}
		}
		else {
			$video = new Video();
		}

		$video->youtube_id = $youtubeVideo->id;
		$video->title = $youtubeVideo->snippet->title;
		$video->description = $youtubeVideo->snippet->description;
		$video->upload_date = date("Y-m-d H:i:s", strtotime($youtubeVideo->snippet->publishedAt));

		// Stats
		$video->duration = self::getDurationSeconds($youtubeVideo->contentDetails->duration) ?? 0;

		if (empty($youtubeVideo->statistics->commentCount)) {
			$video->comment_count = 0;
		}
		else {
			$video->comment_count = $youtubeVideo->statistics->commentCount ?? 0;
		}

		if (empty($youtubeVideo->statistics->viewCount)) {
			$video->view_count = 0;
		}
		else {
			$video->view_count = $youtubeVideo->statistics->viewCount ?? 0;
		}

		if (empty($youtubeVideo->statistics->likeCount)) {
			$video->like_count = 0;
		}
		else {
			$video->like_count = $youtubeVideo->statistics->likeCount ?? 0;
		}

		if (empty($youtubeVideo->statistics->likeCount)) {
			$video->dislike_count = 0;
		}
		else {
			$video->dislike_count = $youtubeVideo->statistics->dislikeCount ?? 0;
		}

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
			Storage::setVisibility($video->youtube_id.'.jpg', 'public');
		}
		if (!empty($youtubeVideo->snippet->channelId)) {
			$channel = Channel::where('youtube_id', '=', $youtubeVideo->snippet->channelId)->first();

			if (empty($channel) && !empty($youtubeVideo->snippet->channelTitle)) {
				$channel = new Channel;

				$channel->title = $youtubeVideo->snippet->channelTitle;
				$channel->youtube_id = $youtubeVideo->snippet->channelId;
				$channel->description = "";
				$channel->slug = str_slug($channel->title);
				$channel->save();
			}


			$video->channel_id = $channel->id;
		}

		$video->slug = str_slug($video->title);

		$video->updated_at = \Carbon\Carbon::now();

		if (is_null($video->captions)) {
			//$video->captions = self::getVideoTranscript($video->youtube_id);
			//sleep(rand(1,5));
		}

		$video->save();

		event(new VideoUpdated($video));

		logger()->info("Task complete for ".$id);

	}

	private static function getDurationSeconds($duration){
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

    public static function getVideoGame($youtube_id) {
        $url = "https://gaming.youtube.com/watch?v=".$youtube_id;

        try {
            $embed = (new Client)->get('https://gaming.youtube.com/watch?v=' . $youtube_id, ['headers' => ['User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36']])->getBody()->getContents();
            if (preg_match('/{"contents":\[{"compactGameRenderer":((.+?)}\]},(.+?)}\]})/', $embed, $gameMatches)) {
                $gameData = json_decode($gameMatches[1] . '}');
                return $gameData->title->runs[0]->text;
            }
            else {
                return 'Unknown';
            }
        }
        catch (\Exception $e) {
            return 'Unknown';
        }
        
        return 'Unknown';
    }

	public static function getVideoTranscript($id) {
		$youtube_dl = env('YOUTUBE_DL');

		$command = $youtube_dl.
			" ".$id.
			" --write-sub".
			" --write-auto-sub".
			" --skip-download".
			" -o '".storage_path()."/captions/%(id)s'".
			" | grep 'Writing video subtitles to:'";

		exec($command, $output, $status);

		if ($status !== 0) {
			return false;
		}

		$subtitles = explode(":", $output[0]);
		$subtitlesPath = trim($subtitles[1]);

		$subtitles = Subtitles::load($subtitlesPath);

		// Keep things tidy
		Storage::disk('local')->delete($subtitlesPath);

		$subtitles = $subtitles->getInternalFormat();

		foreach ($subtitles as $line) {
			foreach ($line['lines'] as $caption) {
				$captions[] = strip_tags($caption);
			}
		}

		return implode(" ",$captions);
	}

}