<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoSeries extends Model
{
    //

    public function check($checkAgainst) {
    	preg_match_all($this->pattern, $checkAgainst, $matches);

    	dd($matches);

    }
}
