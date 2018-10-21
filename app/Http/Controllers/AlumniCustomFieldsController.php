<?php

namespace App\Http\Controllers;

use App\AlumniCustomField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class AlumniCustomFieldsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            [
                'table_rows' => AlumniCustomField::select(['key', 'type'])->groupBy(['key', 'type'])->get()
            ]
        );
    }

//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        //
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $response = [
            'status' => 'success'
        ];


        $validator = Validator::make($request->all(), [
            'key' => 'string|required|unique:alumni_custom_fields',
            'type' => 'required'
        ]);


        if (!$validator->passes()) {
            $response['status'] = 'error';

            if (isset($validator->errors()->messages()['key'])) {
                $response['errors'] = $validator->errors()->messages()['key'];
            }

            if (isset($validator->errors()->messages()['type'])) {
                $response['errors'] = array_merge($response['errors'], $validator->errors()->messages()['type']);
            }

        } else {
            $alcf = new AlumniCustomField();
            $alcf->type = $request->type;
            $alcf->key = $request->key;
            $alcf->save();
        }


        return response()->json($response);

    }

//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function show($id)
//    {
//        //
//    }

//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function edit($id)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, $id)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy($id)
//    {
//        //
//    }
}
