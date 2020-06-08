<?php

namespace App;

use App\Member;
use App\Services\YouTube;
use App\Video;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $guarded = [];

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function members()
    {
        return $this->belongsToMany(Member::class);
    }

    public static function thatNeedsUpdating()
    {
        return Channel::where('title', '')
            ->orWhere('updated_at', '<=', now()->subDays(20))
            ->get();
    }

    public function updateFromSource()
    {
        $this->update((array) $this->fromSource());

        return $this;
    }

    public function fromSource()
    {
        switch($this->source) {
            case "youtube":
            default:
                return YouTube::getChannel($this->source_id);
        }

        return null;
    }


}
