<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function alumnis() {

    	return $this->belongsToMany('App\Alumni')->withTimestamps();
    	
    }

}
