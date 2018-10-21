<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlumniCustomField extends Model
{

    /**
     * Returns all alumni custom fields as an assoc. array id as the key
     * @return array
     */
    public static function getAllCustomFieldsArray(){
        $return = [];
        foreach(self::all() as $acf){
            $return[$acf->id] = $acf;
        }
        return $return;
    }

}
