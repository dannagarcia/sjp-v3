<?php

namespace App\Http\Controllers;

use App\AlumniAlumniCustomField;
use App\AlumniCustomField;
use Illuminate\Http\Request;

use DB;
use App\Alumni;
use DateTime;
use Mockery\Exception;

class AlumniController extends Controller
{
    private $rules = [
        'fName' => 'required',
        'lName' => 'required',
        'nickname' => 'required',
        'alumni_type' => 'required',
        'telephone' => 'string|nullable',
        'mobile' => 'string|nullable',
        'fax' => 'string|nullable',
        'birthdate' => 'date_format:m-d-Y|nullable',
        'ordination' => 'date_format:m-d-Y|nullable'
    ];

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
    public function create(Request $request)
    {
        return view('alumni.create',
            [
                'redirect_to' => $request->redirect_to,
                'alumni_custom_fields' => AlumniCustomField::all()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::beginTransaction();

        try {

            $request->validate($this->rules);
            $alumni = new Alumni;
            $alumni->first_name = $request->input('fName');
            $alumni->last_name = $request->input('lName');
            $alumni->middle_initial = $request->input('middle_initial');
            $alumni->nickname = $request->input('nickname');
            $alumni->alumni_type = $request->input('alumni_type');
            $alumni->years_in_sj = $request->input('yrs_sj');
            $alumni->diocese = $request->input('diocese');
            if (isset($request->birthdate)) {
                $alumni->birthdate = DateTime::createFromFormat('m-d-Y', $request->birthdate)->format('Y-m-d');
            }
            if (isset($request->ordination)) {
                $alumni->ordination = DateTime::createFromFormat('m-d-Y', $request->ordination)->format('Y-m-d');
            } else {
                $alumni->ordination = null;
            }
            $alumni->address = $request->input('address');
            $alumni->telephone_num = $request->input('telephone');
            $alumni->fax_num = $request->input('fax');
            $alumni->mobile_num = $request->input('mobile');
            $alumni->email = $request->input('email');

            // new fields
            $alumni->bec = $request->input('bec');
            $alumni->batch_year = $request->input('batch_year');

            $alumni->save();

            /**
             * Custom fields
             */
            foreach (AlumniCustomField::all() as $alcf) {
                if (!empty($request->{$alcf->id})) {
                    $aalcf = new AlumniAlumniCustomField();
                    $aalcf->alumni_id = $alumni->id;
                    $aalcf->alumni_custom_field_id = $alcf->id;
                    $aalcf->value = $request->{$alcf->id};
                    $aalcf->save();
                }
                // if empty continue to next alcf
            }

        } catch (Exception $e) {
            DB::rollBack();
        }

        DB::commit();


        $request->session()->flash('message', 'Successfuly registered');
        if ($request->redirect_to) {
            return redirect($request->redirect_to);
        }


        return redirect('/alumni');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $alumni = Alumni::find($id);
        $events = $alumni->events;

        foreach (AlumniAlumniCustomField::where('alumni_id', $alumni->id)->get() as $aacf) {
            $alumni->{$aacf->alumni_custom_field_id} = $aacf->value;
        }

        return view('alumni.show')
            ->with('alumni', $alumni)
            ->with('events', $events)
            ->with('alumni_custom_fields', AlumniCustomField::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $alumni = Alumni::find($id);

        foreach (AlumniAlumniCustomField::where('alumni_id', $alumni->id)->get() as $aacf) {
            $alumni->{$aacf->alumni_custom_field_id} = $aacf->value;
        }

        return view('alumni.edit')
            ->with('alumni', $alumni)
            ->with('redirect', $request->redirect_to)
            /**
             * Mapping
             */
            ->with('alumni_custom_fields', AlumniCustomField::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $request->validate($this->rules);
        $alumni = Alumni::find($request->id); // found on input hidden field in view
        $alumni->first_name = $request->input('fName');
        $alumni->last_name = $request->input('lName');
        $alumni->middle_initial = $request->input('middle_initial');
        $alumni->nickname = $request->input('nickname');
        $alumni->alumni_type = $request->input('alumni_type');
        $alumni->years_in_sj = $request->input('yrs_sj');
        $alumni->diocese = $request->input('diocese');
        if ($request->birthdate == false) {
            $alumni->birthdate = null;
        } else {
            $alumni->birthdate = DateTime::createFromFormat('m-d-Y', $request->birthdate)->format('Y-m-d');
        }
        if ($request->ordination == false) {
            $alumni->ordination = null;
        } else {
            $alumni->ordination = DateTime::createFromFormat('m-d-Y', $request->ordination)->format('Y-m-d');
        }

        $alumni->address = $request->input('address');
        $alumni->telephone_num = $request->input('telephone');
        $alumni->fax_num = $request->input('fax');
        $alumni->mobile_num = $request->input('mobile');
        $alumni->email = $request->input('email');
        // new fields
        $alumni->bec = $request->input('bec');
        $alumni->batch_year = $request->input('batch_year');

        $alumni->save();

        /**
         * Custom fields
         */
        foreach (AlumniCustomField::all() as $alcf) {
            if (!empty($request->{$alcf->id})) {
                AlumniAlumniCustomField::updateOrCreate([
                    'alumni_id' => $alumni->id,
                    'alumni_custom_field_id' => $alcf->id,
                ],[ 'value' => $request->{$alcf->id} ]);
            }
            // if empty continue to next alcf
        }


        $request->session()->flash('message', 'Update Sucess');

        if ($request->redirect_to) {
            return redirect($request->redirect_to);
        }
        return redirect('/alumni');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Alumni::destroy($id);
        $request->session()->flash('message', 'Delete Sucess');
        return redirect('/alumni');
    }


}
