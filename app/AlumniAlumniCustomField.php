<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlumniAlumniCustomField extends Model
{

    protected $table = 'alumni_alumni_custom_fields';

    protected $fillable = ['alumni_id', 'alumni_custom_field_id', 'value'];


}
