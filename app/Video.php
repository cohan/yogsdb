<?php

namespace App;

use App\Channel;
use App\Services\YouTube;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $guarded = [];

    public static function getVideo($source_id, $source = 'youtube') {
        $video = Video::where('source', '=', $source)->where('source_id', '=', $source_id)->first();

        return $video;
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function toArray()
    {
        return (array) $this->fromSource();
    }

    public function reSource()
    {
        $video = $this->fromSource();

        return Video::createOrUpdate($video);
    }

    public function fromSource()
    {
        switch($this->source) {
            case "youtube":
                return YouTube::getVideo($this->source_id);
        }

        return null;
    }
}
