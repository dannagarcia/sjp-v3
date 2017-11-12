<?php

namespace App\Http\Controllers;

use App\Event;

use App\Alumni;

use Illuminate\Http\Request;

use DB;
use DateTime;
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return view('event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required',
            'event_description' => 'required',
            'event_place' => 'required',
            'event_date' => 'required'
        ]);
        $event = new Event(); // Initialize

        $event->name = $request->input('event_name');
        $event->description = $request->input('event_description');
        $event->place = $request->input('event_place');
        $event->date=  DateTime::createFromFormat('m-d-Y', $request->event_date)->format('Y-m-d');

        $event->save();
        $request->session()->flash('message', 'Successfuly created');
        return redirect('/event');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $event = Event::find($id);
        $attendees = $event->alumnis;

        $attendees_ids = array();
        foreach ($attendees as $key => $value) {
            $attendees_ids[] = $value->id;
        }

        $unattended = Alumni::whereNotIn('id', $attendees_ids)->get();

        return view('event.show')
            ->with('event', $event)
            ->with('attendees', $attendees)
            ->with('unattended', $unattended);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        return view('event.edit')
            ->with('event', $event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'event_name' => 'required',
            'event_description' => 'required',
            'event_place' => 'required',
            'event_date' => 'required'
        ]);
        $event = Event::find($request->id);

        $event->name = $request->input('event_name');
        $event->description = $request->input('event_description');
        $event->place = $request->input('event_place');
        $event->date=  DateTime::createFromFormat('m-d-Y', $request->event_date)->format('Y-m-d');


        $event->save();
        $request->session()->flash('message', 'Update Sucess');
        return redirect('event/' . $event->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function attend(Request $request)
    {
        DB::table('alumni_event')->insert([
            'alumni_id' => $request->alumni_id,
            'event_id' => $request->event_id
         ]);
        return redirect('/event/' . $request->event_id);
        
    }

    /**
     * Removes the alumni_event m2m
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request)
    {
        DB::table('alumni_event')
        ->where('alumni_id', $request->alumni_id)
        ->where('event_id', $request->event_id)
        ->delete();
        return redirect('/event/' . $request->event_id);
        
    }

}
