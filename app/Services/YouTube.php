<?php

namespace App\Services;

use Alaouy\Youtube\Facades\Youtube as YT;
use App\Channel;
use App\Video;
use Cache;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Str;

class YouTube
{
    public static function getChannel($id)
    {
        return new YouTubeChannel(Cache::remember('channel-youtube-'.md5(json_encode($id)), now()->addDays(28), function () use ($id) {
            return YT::getChannelById($id);
        }));
    }

    public static function getVideo($id)
    {
        return new YouTubeVideo(Cache::remember('video-youtube-'.md5(json_encode($id)), now()->addDays(28), function () use ($id) {
            return YT::getVideoInfo($id);
        }));
    }
}

class YouTubeChannel
{

    public function __construct($channel)
    {
        $intChannel = Channel::where('source', 'youtube')->where('source_id', $channel->id)->first();

        if (empty($intChannel->id)) {
            $intChannel = Channel::create([
                'source_id' => $channel->id
            ]);
            $intChannel->fresh();
        }

        $this->id = $intChannel->id ?? null;


        $this->source = 'youtube';
        $this->source_id = $channel->id;
        $this->youtube_id = $channel->id;

        $this->official = $intChannel->official ?? false;

        $this->title = $channel->snippet->title;
        $this->slug = Str::slug($this->title);
        $this->description = $channel->snippet->description;
        $this->created_at = Carbon::parse($channel->snippet->publishedAt);
        $this->updated_at = $intChannel->updated_at ?? now();

        $this->image = $channel->snippet->thumbnails->maxres->url
            ?? $channel->snippet->thumbnails->high->url
            ?? $channel->snippet->thumbnails->default->url;

        return $this;
    }

    public function toArray()
    {
        return (array) $this;
    }
}

class YouTubeVideo
{
    public function __construct($video)
    {
        $intVideo = Video::where('source', 'youtube')->where('source_id', $video->id)->first();

        if (empty($intVideo->id)) {
            $intVideo = Video::create([
                'source' => 'youtube',
                'source_id' => $video->id,
                'channel_id' => YouTube::getChannel($video->snippet->channelId)->id
            ]);

            dd($intVideo);
            $intVideo->fresh();
        }

        $this->id = $intVideo->id ?? null;

        $this->source = 'youtube';
        $this->source_id = $video->id;

        $this->youtube_id = $video->id; // backwards compatibility
        $this->title = $video->snippet->title;
        $this->slug = Str::slug($this->title);
        $this->description = $video->snippet->description;
        $this->channel_id = $intVideo->channel_id ?? 0;
        $this->created_at = Carbon::parse($video->snippet->publishedAt);
        $this->upload_date = $this->created_at; // backwards compatibility
        $this->updated_at = $intVideo->updated_at ?? now();

        $this->duration = (int) $this->getDurationSeconds($video->contentDetails->duration);

        $this->view_count = (int) $video->statistics->viewCount ?? 0;
        $this->like_count = (int) $video->statistics->likeCount ?? 0;
        $this->dislike_count = (int) $video->statistics->dislikeCount ?? 0;
        $this->favorite_count = (int) $video->statistics->favoriteCount ?? 0;
        $this->comment_count = (int) $video->statistics->commentCount ?? 0;

        $this->game = (string) $this->getVideoGame();

        $this->tags = (array) $video->snippet->tags;

        $this->image = $video->snippet->thumbnails->maxres->url
            ?? $video->snippet->thumbnails->high->url
            ?? $video->snippet->thumbnails->default->url;

        return $this;

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

    public function getVideoGame() {
        // It's broke. Might as well save a round trip
        return "Unknown";

        $youtube_id = $this->source_id;

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


}
