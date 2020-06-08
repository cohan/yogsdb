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

    public static function thatNeedsUpdating()
    {
        return Video::where('title', '')
            ->orWhere('updated_at', '<=', now()->subDays(20))
            ->get();
    }

    public function updateFromSource()
    {
        // Shouldn't be called too often, as it only updates the one vid.
        // We should batch into 50s.
        $this->update((array) $this->fromSource());

        return $this;
    }

    protected function fromSource()
    {
        switch($this->source) {
            case "youtube":
                return YouTube::getVideo($this->source_id);
        }

        return null;
    }

}
