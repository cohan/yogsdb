<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Channel extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['youtube_id'];

    protected $appends = array('image');

    protected $hidden = [
        'thumbnail',
        'deleted_at',
    ];

    /**
     * Get the videos for the channel.
     */
    public function videos()
    {
        return $this->hasMany('App\Video')->orderBy("upload_date", "desc");
    }

    /**
     * Get the assumed stars for the channel
     */
    public function stars()
    {
        return $this->hasMany('App\Star', 'youtube_id', 'youtube_id');
    }

    public function getImageAttribute()
    {
        return "https://cdn.yogsdb.com/channel/".$this->youtube_id.".jpg";
    }
}
