<?php

namespace App;

use App\Channel;
use App\Services\YouTube;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $guarded = [];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function scopeYoutube()
    {
        return $this->where('source', 'youtube');
    }
    public function scopeTwitch()
    {
        return $this->where('source', 'twitch');
    }



    public static function thatNeedUpdating()
    {
        return Video::whereNull('title')
            ->orWhere('updated_at', '<=', now()->subDays(20))
            ->get();
    }

    public function updateFromSource()
    {
        // Shouldn't be called too often, as it only updates the one vid.
        // We should batch into 50s for regular usage.

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
