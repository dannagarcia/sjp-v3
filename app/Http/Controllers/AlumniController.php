<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Alumni;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $alumni = Alumni::all();
        return view('alumni.index', compact('alumni'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alumni.create');
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
            'fName' => 'required',
            'lName' => 'required',
        ]);
        $alumni = new Alumni;
        $alumni->first_name = $request->input('fName');
        $alumni->last_name = $request->input('lName');
        $alumni->alumni_type = $request->input('alumni_type');
        $alumni->years_in_sj = $request->input('yrs_sj');
        $alumni->diocese = $request->input('diocese');
        $alumni->birthdate = $request->input('birthdate');
        $alumni->ordination = $request->input('ordination');
        $alumni->address = $request->input('address');
        $alumni->telephone_num = $request->input('telephone');
        $alumni->fax_num = $request->input('fax');
        $alumni->mobile_num = $request->input('mobile');
        $alumni->email = $request->input('email');

        $alumni->save();
        return redirect('/alumni');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alumni = Alumni::find($id);
        $events = $alumni->events;
        return view('alumni.show')
            ->with('alumni', $alumni)
            ->with('events', $events);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alumni = Alumni::find($id);
        return view('alumni.edit')
            ->with('alumni', $alumni);
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
        $alumni = Alumni::find($request->id); // found on input hidden field in view
        $alumni->first_name = $request->input('fName');
        $alumni->last_name = $request->input('lName');
        $alumni->alumni_type = $request->input('alumni_type');
        $alumni->years_in_sj = $request->input('yrs_sj');
        $alumni->diocese = $request->input('diocese');
        $alumni->birthdate = $request->input('birthdate');
        $alumni->ordination = $request->input('ordination');
        $alumni->address = $request->input('address');
        $alumni->telephone_num = $request->input('telephone');
        $alumni->fax_num = $request->input('fax');
        $alumni->mobile_num = $request->input('mobile');
        $alumni->email = $request->input('email');

        $alumni->save();

        return redirect('/alumni/' . $request->id);

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



}
