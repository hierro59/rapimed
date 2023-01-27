<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\OperationService;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OperationServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/welcome');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        switch ($request['action']) {
            case 'save_log':
                $data = [
                    'type_log' => $request['type_log'],
                    'user_id' => $request['user_id'],
                    'activity' => $request['activity'],
                    'details' => $request['details']
                ];
                DB::table('logs_users')->insert($data);
                break;

            default:
                echo "Prueba OprationServices OK!";
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OperationService  $operationService
     * @return \Illuminate\Http\Response
     */
    public function show(OperationService $operationService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OperationService  $operationService
     * @return \Illuminate\Http\Response
     */
    public function edit(OperationService $operationService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OperationService  $operationService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OperationService $operationService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OperationService  $operationService
     * @return \Illuminate\Http\Response
     */
    public function destroy(OperationService $operationService)
    {
        //
    }
}
