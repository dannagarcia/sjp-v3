<?php

namespace App\Http\Controllers;

use App\Alumni;
use Illuminate\Http\Request;
use Mockery\Exception;

class AlumniAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = [
            'status' => 'error',
        ];

        try {
            $alumni = Alumni::all();
        } catch (Exception $e) {
            $response['message'] = $e->getMessage();
            $response['error_code'] = $e->getCode();
        }

        if (!empty($alumni)) {
            $response['status'] = 'success';
            $response['table_rows'] = $alumni;
        } else {
            $response['status'] = 'success';
            $response['table_rows'] = 0;
        }

        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = [
            'status' => 'not found',
            'message' => 'Invalid id. Alumni not found'
        ];

        try {

            $alumni = Alumni::find($id);
            $alumni->loadCustomFields();


            if (!empty($alumni)) {
                $response['status'] = 'success';
                $response['alumnus'] = $alumni;
                unset($response['message']);

            }
        } catch (Exception $e) {
            // Do nothing return default
        }
        return response()
            ->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
