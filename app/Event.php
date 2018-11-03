<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function alumnis() {

    	return $this->belongsToMany(Alumni::class)->withTimestamps();

    }

    /**
     * Returns t he unatendees for a specified event
     * @param Event $event
     * @return mixed
     */
    public static function get_unatendees(Event $event){
        $attendees_ids = [];
        $attendees = $event->alumnis;
        foreach ($attendees as $key => $value) {
            $attendees_ids[] = $value->id;
        }

        $unattended = Alumni::whereNotIn('id', $attendees_ids)->get();

        return $unattended;
    }

}
