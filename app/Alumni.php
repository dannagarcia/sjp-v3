<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    public function events() {

    	return $this->belongsToMany(Event::class)->withTimestamps();

    }

}
