<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Setting;
use Mockery\Exception;
use App\Alumni;


class SettingsController extends Controller
{

    public function index(Request $request)
    {
        dd('here');

    }

    public function alumni_custom_fields()
    {
        return view('settings/alumni_custom_fields');
    }

    public function id()
    {
        $idSettings = App\Setting::find(1); // Always 1
        return view('settings/id')
            ->with('settings', $idSettings)
            ->with('default_settings', json_encode(Setting::getDefaultIdSettings()));
    }

    public function update(Request $request)
    {

        $this->validate($request, [
            'new_value' => 'json|required'
        ]);

        try {

            $new_value = $request->input('new_value');

            /**
             * Validate keys
             */
            $decoded = (array)json_decode($new_value);

            foreach (Setting::getDefaultIdSettings() as $key => $value) {
                if (!isset($decoded[$key])) {
                    throw new Exception("Invalid keys passed");
                }
            }

            $setting = Setting::find(1);
            $setting->value = json_encode($decoded); // using the decoded to remove spaces when stored
            $setting->save();

        } catch (Exception $e) {
            dd($e);

        }

        return redirect('/settings/id');

    }

    public function preview_id(Request $request){

        $json = $request->input('json');

        $idSettings = json_decode($json);

        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper($idSettings->paper_size, $idSettings->orientation);

        /**
         * Sample alumni
         */
        $alumni = new Alumni();
        $alumni->nickname = "BENJIEE";
        $alumni->title = "Father";
        $alumni->first_name = "Benjamin";
        $alumni->last_name ="Espiritu";
        $alumni->diocese = "Diocese of San Fernando";

        $data = [
            'alumni' => $alumni,
            'settings' => $idSettings
        ];
        $pdf = $pdf->loadView('pdf.id', $data);
        return $pdf->stream();

    }


}
