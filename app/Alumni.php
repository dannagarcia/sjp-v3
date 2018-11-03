<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    /**
     * Get all events associated with this alumni
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function events()
    {
        return $this->belongsToMany(Event::class)->withTimestamps();
    }

    /**
     * Adds the alumni custom fields to attributes
     */
    public function loadCustomFields($direct_to_model = false)
    {
        $acf = AlumniCustomField::getAllCustomFieldsArray();
        /**
         * TODO: In refactoring use below code or just join the tables
         */
        //$aacf = AlumniAlumniCustomField::where('alumni_id', $this->id)->get();

        $customFields = [];

        foreach ($acf as $field) {
            /**
             * TODO: Refactor this
             */
            $currentAacf = AlumniAlumniCustomField::where('alumni_custom_field_id', $field->id)
                ->where('alumni_id', $this->id)
                ->first();

            /**
             *
             */
            $customFields[$field->key] = (!empty($currentAacf) ? $currentAacf->value : '');

        } // end foreach

        if($direct_to_model){

            /**
             * Directly inject to model attributes
             */
            foreach($customFields as $cfk =>  $cfvalue) {
                $this->{$cfk} = $cfvalue;
            }
        } else {
            /**
             * Store in array
             */
            $this->customFields = $customFields;
        }

    }

}
