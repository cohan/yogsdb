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

    public function toArray()
    {
        return (array) $this->fromSource();
    }

    public function fromSource()
    {
        switch($this->source) {
            case "youtube":
                return YouTube::getChannel($this->source_id);
        }

        return null;
    }
}
