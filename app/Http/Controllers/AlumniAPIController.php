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


        if (!$q) {
            throw new Exception("Forbidden.");
        }

        $q = strtolower($q);
        $response = Alumni::select('alumnis.id', 'first_name', 'last_name', 'email', 'events.id AS event_id',
            DB::raw('CONCAT(last_name,  ", ", first_name, " (", email ,")") AS formatted'))
            ->join('alumni_event', 'alumni_event.alumni_id', '=', 'alumnis.id', 'left')
            ->join('events', 'alumni_event.event_id', '=', 'events.id', 'left')
            ->where('first_name', 'like', '%' . $q . '%')
            ->orWhere('last_name', 'like', '%' . $q . '%')
            ->orWhere('alumnis.id', 'like', '%' . $q . '%')
            ->orWhere('email', 'like', '%' . $q . '%')
            ->orWhere(DB::raw('CONCAT(last_name, ", ", "first_name")'), 'like', '%' . strtolower($q) . '%')
            ->orderBy('last_name')
            ->get();

        $suggestions = [];
        $alumni = $response;

        foreach ($alumni as $key => $value) {

            if (!empty($value['event_id'])) // alumni already added to event
                continue;

            $suggestionText = empty($value->formatted) ? $value->first_name : $value->formatted;
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
