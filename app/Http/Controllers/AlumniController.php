<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\alumni;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $alumni = alumni::all();
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
        $alumni = new Alumni;
        $alumni->first_name = $request->input('fName');
        $alumni->last_name = $request->input('lName');
        $alumni->alumni_type = $request->input('alumni_type');
        $alumni->years_in_sj = $request->input('yrs_sj');
        $alumni->diocese = $request->input('diocese');
        $alumni->ordination = $request->input('ordination');
        $alumni->address = $request->input('sddress');
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
        $alumni = alumni::find($id);
        return view('alumni.show', compact('alumni'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alumni = alumni::find($id);
        return view('alumni.edit', compact('alumni'));
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
        //
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
