<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\Specialist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $role = DB::Table('model_has_roles')->where('model_id', '=', $id)->get();
        if ($role[0]->role_id != 3) {
            $array = [];
            $citas = DB::Table('citas')->orderBy('created_at', 'DESC')->get();
            $specialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('status', '=', 1)->get();
            for ($i = 0; $i < count($citas); $i++) {
                $myspecialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('id', '=', $citas[$i]->specialist_id)->get();
                array_push($array, $myspecialist);
            }
            return view('citas.index', compact('citas', 'array', 'specialist', 'id'));
        } elseif ($role[0]->role_id == 4) {
            $citas = DB::Table('citas')->where('specialist_id', '=', $id)->get();
            return view('citas.index', compact('citas'));
        } else {
            $array = [];
            $citas = DB::Table('citas')->where('user_id', '=', $id)->orderBy('created_at', 'DESC')->get();
            $specialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('status', '=', 1)->get();
            for ($i = 0; $i < count($citas); $i++) {
                $myspecialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('id', '=', $citas[$i]->specialist_id)->get();
                array_push($array, $myspecialist);
            }
            return view('citas.index', compact('citas', 'specialist', 'id', 'array'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('citas.index');
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
            'specialist_id' => 'required',
            'fecha_cita' => 'required',
            'tipo' => 'required'
        ]);

        $input = $request->all();

        $cita = Citas::create($input);

        return redirect()->route('citas.index')
            ->with('success', 'Cita created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('citas.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('citas.edit');
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
