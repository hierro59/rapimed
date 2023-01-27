<?php

namespace App\Http\Controllers\Client;

use App\Models\LogUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LogUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
                DB::table('log_users')->insert($data);
                break;

            default:
                echo "Prueba OprationServices OK!";
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LogUser  $logUser
     * @return \Illuminate\Http\Response
     */
    public function show(LogUser $logUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LogUser  $logUser
     * @return \Illuminate\Http\Response
     */
    public function edit(LogUser $logUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LogUser  $logUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LogUser $logUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LogUser  $logUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(LogUser $logUser)
    {
        //
    }
}
