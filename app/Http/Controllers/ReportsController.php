<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Alumni;
use Illuminate\Support\Facades\View;
use Jimmyjs\ReportGenerator\ReportMedia\PdfReport;
use Maatwebsite\Excel\Facades\Excel;


class ReportsController extends Controller
{
    public function test(Request $request){
        Excel::create('Laravel Excel', function($excel) {

            $excel->sheet('Excel sheet', function($sheet) {

                $sheet->setOrientation('landscape');

            });

        })->export('xls');
    }
}
