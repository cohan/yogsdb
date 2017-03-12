<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alert extends Model
{
    //
    use SoftDeletes;

	protected $casts = [
		'stars' => 'array',
		'series' => 'array',
		'not_stars' => 'array',
		'not_series' => 'array',
	];

	public function user() {
		return $this->belongsTo('App\User');
	}
}
