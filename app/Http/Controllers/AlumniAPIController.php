<?php

namespace App\Http\Controllers;

use App\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class AlumniAPIController extends Controller
{

    public function search(Request $request)
    {
        $q = $request->q;
        $event_id = $request->event_id;

        if(!$q){
            $response = Alumni::select('id' ,'first_name', 'last_name', 'email',
                DB::raw('CONCAT(last_name,  ", ", first_name, " (", email ,")") AS formatted'))
                ->get();
        } else {
            $response = Alumni::select('id', 'first_name', 'last_name', 'email',
                DB::raw('CONCAT(last_name,  ", ", first_name, " (", email ,")") AS formatted'))
                /**
                 * TODO
                 */
                //->join('alumni_event', 'alumni_event.alumni_id', '=', 'alumni.id','inner')
                ->where('first_name', 'like', '%' . $q . '%')
                ->orWhere('last_name', 'like', '%' . $q . '%')
                ->orWhere('email', 'like', '%' . $q . '%')
                ->orWhere(DB::raw('CONCAT(last_name, ", ", "first_name")'), 'like', '%' . $q . '%')
                ->orderBy('last_name')
                ->get();
        }


        return response()->json($response);
    }

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
            $alumni->loadCustomFields(true);


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
