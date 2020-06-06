<?php

namespace App;

use App\Channel;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $guarded = [];

    public function channels()
    {
        return $this->belongsToMany(Channel::class);
    }
}
