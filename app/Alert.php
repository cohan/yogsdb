<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    //

	protected $casts = [
		'stars' => 'array',
		'series' => 'array',
		'not_stars' => 'array',
		'not_series' => 'array',
	];
}
