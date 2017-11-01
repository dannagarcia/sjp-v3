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

        Excel::create('Alumni', function ($excel) {

            $excel->sheet('Ordained', function ($sheet) {


                $ordained = Alumni::select('first_name', 'last_name', 'diocese', 'birthdate',
                    'ordination', 'address', 'telephone_num', 'fax_num', 'mobile_num', 'email')
                    ->where('alumni_type', 'Ordained')
                    ->get();
                $sheet->fromModel($ordained->toArray(), null, 'A1', false, true);
                $sheet->setOrientation('landscape');
                $sheet->row(1, array(
                    'First Name', 'Last Name', 'Dicoese', 'Birthdate', 'Ordination', 'Address', 'Telephone Number',
                    'Fax Number', 'Mobile Number', 'Email'
                ));
                $sheet->prependRow(1, array(
                    'Ordained as of ' . Carbon::now()
                ));

                // Set black background
                $sheet->row(2, function($row) {

                    // call cell manipulation methods
                    $row->setBackground('#000000');

                });


                $sheet->mergeCells('A1:J1');
                // Formatting
            });

            $excel->sheet('Lay', function ($sheet) {
                $lay = Alumni::select( 'first_name', 'last_name', 'birthdate',
                    'years_in_sj', 'address', 'telephone_num', 'fax_num', 'mobile_num', 'email')
                    ->where('alumni_type', 'Lay')
                    ->get();
                $sheet->fromModel($lay->toArray(), null, 'A1', false, true);
                $sheet->setOrientation('landscape');
                $sheet->row(1, array(
                    'First Name', 'Last Name', 'Birthdate', 'Years in San Jose', 'Address', 'Telephone Number',
                    'Fax Number', 'Mobile Number', 'Email'
                ));
                $sheet->prependRow(1, array(
                    'Ordained as of ' . Carbon::now()
                ));
                $sheet->mergeCells('A1:J1');

            });


        })->export('xls');

    }

    public function eventreport(Request $request) {

        $event = new Event();

        $event->name = $request->input('event_name');

        dd($event->name);

        // Excel::create('Laravel Excel', function ($excel) {

        //     $excel->sheet('Event', function ($sheet) {
        //         $event = Event::select('name', 'description', 'place', 'date')->get();
        //     });

        // }
    }
}
