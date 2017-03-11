<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Channel extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['youtube_id'];

    /**
     * Get the videos for the channel.
     */
    public function videos()
    {
        return $this->hasMany('App\Video');
    }
}
