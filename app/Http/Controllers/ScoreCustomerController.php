<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use Illuminate\Http\Request;
use App\Models\ScoreCustomer;

class ScoreCustomerController extends Controller
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
        $this->validate($request, [
            'cita_id' => 'required',
            'score' => 'required',
        ]);
        $input = $request->all();
        ScoreCustomer::create($input);
        return redirect()->route('home')
            ->with('success', 'Calificación realizada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ScoreCustomer  $scoreCustomer
     * @return \Illuminate\Http\Response
     */
    public function show(ScoreCustomer $scoreCustomer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ScoreCustomer  $scoreCustomer
     * @return \Illuminate\Http\Response
     */
    public function edit(ScoreCustomer $scoreCustomer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ScoreCustomer  $scoreCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScoreCustomer $scoreCustomer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ScoreCustomer  $scoreCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScoreCustomer $scoreCustomer)
    {
        //
    }
}
