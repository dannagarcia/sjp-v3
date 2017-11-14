<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    /**
     * Get all events associated with this alumni
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function events() {
    	return $this->belongsToMany(Event::class)->withTimestamps();
    }

}
