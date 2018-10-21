<?php

namespace App\Http\Controllers;

use App\User;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Alumni;
use App\Event;
use Illuminate\Support\Facades\View;
use Jimmyjs\ReportGenerator\ReportMedia\PdfReport;
use Maatwebsite\Excel\Facades\Excel;
use App;


class ReportsController extends Controller
{

    public function reports(Request $request)
    {

        Excel::create('All-entries-as-of' . Carbon::now(), function ($excel) {

            $excel->sheet('Ordained', function ($sheet) {


                /**
                 * TODO: Add left join here or rewrite query
                 */
                $ordained = Alumni::select('first_name', 'last_name', 'middle_initial', 'nickname', 'bec', 'batch_year', 'diocese', 'birthdate',
                    'ordination', 'address', 'telephone_num', 'fax_num', 'mobile_num', 'email')
                    ->where('alumni_type', 'ordained')
                    ->get();
                $sheet->fromModel($ordained->toArray(), null, 'A1', false, true);
                $sheet->setOrientation('landscape');
                $sheet->row(1, array(
                    'First Name', 'Last Name', 'Middle Initial', 'Nickname', 'BEC', 'Batch Year', 'Diocese', 'Birthdate', 'Ordination', 'Address', 'Telephone Number',
                    'Fax Number', 'Mobile Number', 'Email'
                ));
                $sheet->prependRow(1, array(
                    'List of all registered Ordained as of ' . Carbon::now()
                ));

                $sheet->mergeCells('A1:J1');
                // Formatting
            });

            $excel->sheet('Lay', function ($sheet) {
                /**
                 * TODO: Add left join here
                 */
                $lay = Alumni::select('first_name', 'last_name', 'middle_initial', 'nickname', 'bec', 'batch_year', 'birthdate',
                    'years_in_sj', 'address', 'telephone_num', 'fax_num', 'mobile_num', 'email')
                    ->where('alumni_type', 'lay')
                    ->get();
                $sheet->fromModel($lay->toArray(), null, 'A1', false, true);
                $sheet->setOrientation('landscape');
                $sheet->row(1, array(
                    'First Name', 'Last Name', 'Middle Initial', 'Nickname', 'BEC', 'Batch Year', 'Birthdate', 'Years in San Jose', 'Address', 'Telephone Number',
                    'Fax Number', 'Mobile Number', 'Email'
                ));
                $sheet->prependRow(1, array(
                    'List of all registered Lay Alumni as of ' . Carbon::now()
                ));
                $sheet->mergeCells('A1:J1');

            });

            $excel->sheet('Current', function ($sheet) {
                $lay = Alumni::select('first_name', 'last_name', 'middle_initial', 'nickname', 'bec', 'batch_year', 'birthdate',
                    'years_in_sj', 'address', 'telephone_num', 'fax_num', 'mobile_num', 'email')
                    ->where('alumni_type', 'current')
                    ->get();
                $sheet->fromModel($lay->toArray(), null, 'A1', false, true);
                $sheet->setOrientation('landscape');
                $sheet->row(1, array(
                    'First Name', 'Last Name', 'Middle Initial', 'Nickname', 'BEC', 'Batch Year', 'Birthdate', 'Years in San Jose', 'Address', 'Telephone Number',
                    'Fax Number', 'Mobile Number', 'Email'
                ));
                $sheet->prependRow(1, array(
                    'List of all registered Lay Alumni as of ' . Carbon::now()
                ));
                $sheet->mergeCells('A1:J1');

            });

        })->export('xls');

    }


    public function eventreport(Request $request)
    {


        $event = Event::find($request->event_id);
        $alumnis = $event->alumnis;
        $lay = array();
        $ordained = [];
        $current = [];
        foreach ($alumnis as $a) {
            if ($a->alumni_type === 'current') {
                $current[] = [$a->first_name, $a->last_name, $a->middle_initial, $a->nickname, $a->bec, $a->batch_year, $a->birthdate, $a->years_in_sj, $a->address, $a->telephone_num,
                    $a->fax_num, $a->mobile_num, $a->email];
            } elseif ($a->alumni_type === 'lay') {
                $lay[] = [$a->first_name, $a->last_name, $a->middle_initial, $a->nickname, $a->bec, $a->batch_year, $a->birthdate, $a->years_in_sj, $a->address, $a->telephone_num,
                    $a->fax_num, $a->mobile_num, $a->email];
            } elseif ($a->alumni_type === 'ordained') {
                $ordained[] = [$a->first_name, $a->last_name, $a->middle_initial, $a->nickname, $a->bec, $a->batch_year, $a->diocese, $a->birthdate, $a->ordination, $a->address, $a->telephone_num,
                    $a->fax_num, $a->mobile_num, $a->email];
            }

        }


        Excel::create($event->name . '-' . Carbon::now(), function ($excel) use ($ordained, $lay, $current) {

            $excel->sheet('Ordained', function ($sheet) use ($ordained) {

                $sheet->fromArray($ordained, null, 'A1', false, true);
                $sheet->setOrientation('landscape');
                $sheet->row(1, array(
                    'First Name', 'Last Name', 'Middle Initial', 'Nickname', 'Dicoese', 'BEC', 'Batch Year', 'Birthdate', 'Ordination', 'Address', 'Telephone Number',
                    'Fax Number', 'Mobile Number', 'Email'
                ));
                $sheet->prependRow(1, array(
                    'List of all registered Ordained as of ' . Carbon::now()
                ));

                $sheet->mergeCells('A1:J1');

            });

            $excel->sheet('Lay', function ($sheet) use ($lay) {
                $sheet->fromArray($lay);
                $sheet->setOrientation('landscape');
                $sheet->row(1, array(
                    'First Name', 'Last Name', 'Middle Initial', 'Nickname', 'BEC', 'Batch Year', 'Birthdate', 'Years in San Jose', 'Address', 'Telephone Number',
                    'Fax Number', 'Mobile Number', 'Email'
                ));
                $sheet->prependRow(1, array(
                    'Lay as of ' . Carbon::now()
                ));
                $sheet->mergeCells('A1:J1');
            });

            $excel->sheet('Current', function ($sheet) use ($current) {
                $sheet->fromArray($current);
                $sheet->setOrientation('landscape');
                $sheet->row(1, array(
                    'First Name', 'Last Name', 'Middle Initial', 'Nickname', 'BEC', 'Batch Year', 'Birthdate', 'Years in San Jose', 'Address', 'Telephone Number',
                    'Fax Number', 'Mobile Number', 'Email'
                ));
                $sheet->prependRow(1, array(
                    'Lay as of ' . Carbon::now()
                ));
                $sheet->mergeCells('A1:J1');
            });

        })->export('xls');

    }

    public function downloadId($id)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper([0, 0, 288, 432], 'portrait');
//        $pdf->setPaper([0, 0, 270, 360], 'portrait');
        $data = ['alumni' => Alumni::find($id)];
        $pdf = $pdf->loadView('pdf.id', $data);
        return $pdf->stream();

    }
}
