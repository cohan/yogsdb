<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Series extends Model
{
    //
    use SoftDeletes;


    /**
     * Get the videos the star is in.
     */
    public function videos()
    {
    	return $this->belongsToMany('App\Video')->orderBy("upload_date", "desc");
    }

    /**
     * Get the patterns to match the series
     */
    public function patterns()
    {
    	return $this->hasMany('App\AutoSeries');
    }

}
