<?php

namespace App;

use App\Alumni;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    public function events() {

    	return $this->belongsToMany('App\Event')->withTimestamps();

    }

}
