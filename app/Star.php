<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Star extends Model
{
	//
	use SoftDeletes;

	protected $hidden = ['deleted_at'];

	/**
	 * Get the primary channel for the star.
	 */
	public function channel()
	{
		return $this->hasOne('App\Channel', 'youtube_id', 'youtube_id');
	}

	/**
	 * Get the patterns to match the star.
	 */
	public function patterns()
	{
		return $this->hasMany('App\AutoStars');
	}


	/**
	 * Get the videos the star is in.
	 */
	public function videos()
	{
		return $this->belongsToMany('App\Video')->orderBy("upload_date", "desc");
	}
}
