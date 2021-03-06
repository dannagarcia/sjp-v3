<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Event;

use App\Alumni;

use DB;

use Illuminate\Http\Request;
use League\Flysystem\Exception;
use Psy\Exception\ErrorException;

class DashboardController extends Controller
{
    /**
     * @return mixed
     */
    public function index() {
        $current = Carbon::now()->format('Y-m-d');
        $event_today = Event::whereDate('date', $current )
                                ->orderBy('created_at', 'asc')
                                ->first();

        $top_five = Event::orderBy('date', 'desc')->limit(5)->get();


        $event = Event::orderBy('created_at', 'desc')->first();
        $alumni = Alumni::orderBy('created_at', 'desc')->first();

        // return $top_five;

        return view('index')
                ->with('event', $event)
                ->with('alumni', $alumni)
                ->with('event_today', $event_today)
                ->with('top_five', $top_five);


        // if($event_today) {
        //     $event_id = $event_today->id;
        //     $attendants = Event::find($event_id)->alumnis;
        //     $attendants_count = count($attendants); // Number of Attendants

        //     return view('index')
        //         ->with('event', $event)
        //         ->with('alumni', $alumni)
        //         ->with('event_today', $event_today)
        //         ->with('attendants', $attendants)
        //         ->with('attendants_count', $attendants_count)
        //         ->with('event_id', $event_id);

        // } else {
        //     $event_id = null;
        //     return view('index')
        //         ->with('event_id', $event_id);
        // }
// =======

//        $current = Carbon::now()->format('Y-m-d');
//        $events_today = Event::whereDate('date', $current )
//            ->orderBy('created_at', 'asc')
//            ->first();
//        $event_id = 0;
//        foreach ( $events_today as $event_today => $et ) {
//            $event_id = $et->id;
//        }
//        $attendants = Event::find($event_id)->alumnis;

//        $attendants_count = count($attendants); // Number of Attendants

//        $event = Event::orderBy('created_at', 'desc')->first();
//        $alumni = Alumni::orderBy('created_at', 'desc')->first();

//        $counter = 0;

//        return view('index')
//            ->with('event', $event)
//            ->with('alumni', $alumni)
//            ->with('events_today', $events_today)
//            ->with('attendants', $attendants)
//            ->with('attendants_count', $attendants_count)
//            ->with('counter', $counter);
// >>>>>>> c7e7e898cddac0bfa3b10ce9c0c3f15dcdedcf66

    }
}
