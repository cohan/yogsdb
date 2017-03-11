<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    //
	use SoftDeletes;

    protected $fillable = ['youtube_id', 'channel_id'];

    /**
     * Get the channel for the video.
     */
    public function channel()
    {
        return $this->belongsTo('App\Channel');
    }
}
