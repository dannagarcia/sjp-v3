<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;


class SettingsController extends Controller
{

    public function index(Request $request)
    {
        dd('here');

    }

    public function alumni_custom_fields(){
        return view('settings/alumni_custom_fields');
    }


}
