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
        $q = $request->input('query');
        $event_id = $request->input('event_id');


        if (!$q || !$event_id) {
            throw new Exception("Forbidden.");
        }

        $q = strtolower($q);
        $response =
            DB::select("
                SELECT * FROM alumnis WHERE id NOT IN
                    (
                    SELECT a.id
                    FROM alumnis a LEFT JOIN  alumni_event ae 
                        ON a.id = ae.alumni_id
                        LEFT JOIN events e on e.id = ae.event_id
                    WHERE ae.event_id = '$event_id'
                    )
                   AND 
                     (first_name LIKE '%$q%' OR 
                     last_name LIKE '%$q%' OR 
                     nickname LIKE '%$q%' OR 
                     email LIKE '%$q%' OR 
                     CONCAT(first_name, ' ', last_name) LIKE '%$q%' OR
                     id LIKE '%$q%'
                     )
            ;");
//            ->orderBy('last_name')
//            ->get();

        $suggestions = [];
        $alumni = $response;

        foreach ($alumni as $key => $value) {


            $suggestionText = $value->first_name . ' ' . $value->last_name;
            $suggestionText = "({$value->id}) {$suggestionText}";

            $suggestions[] = [
                'value' => $suggestionText,
                'data' => [
                    'id' => $value->id
                ]
            ];
        }


        return response()->json([
            'suggestions' => $suggestions,
            'q' => $q
        ]);
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
            /**
             * Formats fields for view
             * i.e. dates will be converted from the db format yyyy/mm/dd to mm/dd/yyy
             */
            $alumni->formatFieldsForView();


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
