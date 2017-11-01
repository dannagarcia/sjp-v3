<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Alumni;
use App\Event;
use Illuminate\Support\Facades\View;
use Jimmyjs\ReportGenerator\ReportMedia\PdfReport;
use Maatwebsite\Excel\Facades\Excel;


class ReportsController extends Controller
{

    public function reports(Request $request)
    {

        Excel::create('All-entries-as-of' . Carbon::now(), function ($excel) {

            $excel->sheet('Ordained', function ($sheet) {


                $ordained = Alumni::select('first_name', 'last_name', 'diocese', 'birthdate',
                    'ordination', 'address', 'telephone_num', 'fax_num', 'mobile_num', 'email')
                    ->where('alumni_type', 'ordained')
                    ->get();
                $sheet->fromModel($ordained->toArray(), null, 'A1', false, true);
                $sheet->setOrientation('landscape');
                $sheet->row(1, array(
                    'First Name', 'Last Name', 'Dicoese', 'Birthdate', 'Ordination', 'Address', 'Telephone Number',
                    'Fax Number', 'Mobile Number', 'Email'
                ));
                $sheet->prependRow(1, array(
                    'List of all registered Ordained as of ' . Carbon::now()
                ));

//                // Set black background
//                $sheet->row(2, function($row) {
//
//                    // call cell manipulation methods
//                    $row->setBackground('#000000');
//
//                });


                $sheet->mergeCells('A1:J1');
                // Formatting
            });

            $excel->sheet('Lay', function ($sheet) {
                $lay = Alumni::select( 'first_name', 'last_name', 'birthdate',
                    'years_in_sj', 'address', 'telephone_num', 'fax_num', 'mobile_num', 'email')
                    ->where('alumni_type', 'lay')
                    ->get();
                $sheet->fromModel($lay->toArray(), null, 'A1', false, true);
                $sheet->setOrientation('landscape');
                $sheet->row(1, array(
                    'First Name', 'Last Name', 'Birthdate', 'Years in San Jose', 'Address', 'Telephone Number',
                    'Fax Number', 'Mobile Number', 'Email'
                ));
                $sheet->prependRow(1, array(
                    'List of all registered Lay Alumni as of ' . Carbon::now()
                ));
                $sheet->mergeCells('A1:J1');

            });


        })->export('xls');

    }

    public function eventreport(Request $request) {


        $event = Event::find($request->event_id);
        $alumnis =  $event->alumnis;
        $lay = array();
        $ordained  = [];
        foreach ($alumnis as $a){
            if($a->alumni_type === 'lay'){
                $lay[] = [$a->first_name, $a->last_name, $a->birthdate, $a->years_in_sj, $a->address, $a->telephone_num,
                $a->fax_num, $a->mobile_num, $a->email];
            } elseif ($a->alumni_type === 'ordained'){
                $ordained[] = [$a->first_name, $a->last_name, $a->diocese,$a->birthdate, $a->ordination, $a->address, $a->telephone_num,
                    $a->fax_num, $a->mobile_num, $a->email];
            }

        }


        Excel::create($event->name . '-' . Carbon::now(), function($excel) use($ordained, $lay) {

            $excel->sheet('Ordained', function($sheet) use($ordained) {

                $sheet->fromArray($ordained, null, 'A1', false, true);
                $sheet->setOrientation('landscape');
                $sheet->row(1, array(
                    'First Name', 'Last Name', 'Dicoese', 'Birthdate', 'Ordination', 'Address', 'Telephone Number',
                    'Fax Number', 'Mobile Number', 'Email'
                ));
                $sheet->prependRow(1, array(
                    'List of all registered Ordained as of ' . Carbon::now()
                ));

                $sheet->mergeCells('A1:J1');

            });

            $excel->sheet('Lay', function($sheet) use($lay) {
                $sheet->fromArray($lay);
                $sheet->setOrientation('landscape');
                $sheet->row(1, array(
                    'First Name', 'Last Name', 'Birthdate', 'Years in San Jose', 'Address', 'Telephone Number',
                    'Fax Number', 'Mobile Number', 'Email'
                ));
                $sheet->prependRow(1, array(
                    'Lay as of ' . Carbon::now()
                ));
                $sheet->mergeCells('A1:J1');

            });

        })->export('xls');

    }
}
