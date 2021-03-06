<?php

namespace App;

use App\Filters\VideoFilters;
use App\Scopes\RedactRedacted;
use App\Scopes\UpdatedScope;
use App\VideoIndexConfigurator;
use App\VideoSearchRule;
use Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ScoutElastic\Searchable;

class Video extends Model
{
	//
	use SoftDeletes;
	use Searchable;

	protected $indexConfigurator = VideoIndexConfigurator::class;

	protected $searchRules = [
	    VideoSearchRule::class,
	];

	// Here you can specify a mapping for a model fields.
	protected $mapping = [
		'properties' => [
			'title' => [
				'type' => 'text',
				'analyzer' => 'english'
			],
			'description' => [
				'type' => 'text',
				'analyzer' => 'english'
			]
		]
	];
	
	protected $fillable = ['youtube_id', 'channel_id'];

	protected $appends = array('image');

	protected $hidden = [
		'thumbnail',
		'deleted_at',
		'captions',
	];

	protected $casts = [
		'tags' => 'array',
	];

    protected static function booted()
    {
        // static::addGlobalScope(new UpdatedScope);
        // static::addScope(new RedactRedacted);
        
        parent::booted();
    } 


	public function scopeFilter($query, VideoFilters $filters) {
		return $filters->apply($query);
	}

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

	public static function onThisDay($year) {
		$thisday = date('-m-d');

		$videos = Cache::remember('onthisday-'.$year.$thisday, 60, function () use ($year,$thisday) {
			return Video::where('upload_date', '>=', $year.$thisday." 00:00:00")
				->where('upload_date', '<=', $year.$thisday." 23:59:59")
				->orderBy('upload_date', 'desc')
				->get();
		});

		return $videos;
	}

	public function getImageAttribute()
	{
	    return "https://cdn.yogsdb.com/".$this->youtube_id.".jpg";
	}

	/**
	 * Get the indexable data array for the model.
	 *
	 * @return array
	 */
	public function toSearchableArray()
	{
		//dd($this);
		$array = $this->toArray();

		// Customize array...
		
		$searchableArray['title'] = $this->title ?? '';
		$searchableArray['description'] = $this->description ?? '';
		$searchableArray['captions'] = $this->captions ?? '';

		$searchableArray['channel_name'] = $this->channel->title ?? '';

		return $searchableArray;
	}


}
