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

	protected $casts = [
		'tags' => 'array',
	];

	/**
	 * Get the channel for the video.
	 */
	public function channel()
	{
		return $this->belongsTo('App\Channel');
	}

	/**
	 * Get the stars in this video.
	 */
	public function stars()
	{
		return $this->belongsToMany('App\Star');
	}

	/**
	 * Get the series this video is in.
	 */
	public function series()
	{
		return $this->belongsToMany('App\Series');
	}
	public function seriesCount()
	{
		return $this->belongsTo('App\Series')->selectRaw('count(series.id) as aggregate');
	}

	/**
	 * Get the game in this video.
	 */
	public function game()
	{
		return $this->belongsTo('App\Game');
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
