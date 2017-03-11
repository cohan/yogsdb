<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;


class Video extends Model
{
    //
	use SoftDeletes;
    use Searchable;

    protected $fillable = ['youtube_id', 'channel_id'];

    /**
     * Get the channel for the video.
     */
    public function channel()
    {
        return $this->belongsTo('App\Channel');
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }
}
