<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * @return array
     */
    public static function getDefaultIdSettings(){
        return [
            'paper_size' => [0, 0, 288, 432],
            'orientation' => 'portrait',
            'position' => [
                'from_top' => '35%',
                'from_left' => '50%'
            ],
            'title_font_size' => '0.75em',
            'nickname_proportion' => '30',
            'details_font_size' => '0.8em',
        ];
    }
}
