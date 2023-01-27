<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\Score;
use App\Models\LogUser;
use App\Models\Operation;
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
        if ($role[0]->role_id === 3) { // Especialistas
            $specialistEmail = Auth::user()->email;
            $specialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('email', '=', $specialistEmail)->get();
            $citas = DB::Table('citas')->where('specialist_id', '=', $specialist[0]->id)->get();
            $array = [];
            for ($i = 0; $i < count($citas); $i++) {
                $paciente = DB::Table('users')->select('id', 'name', 'email')->where('id', '=', $citas[$i]->user_id)->get();
                array_push($array, $paciente);
            }
            return view('citas.index', compact('citas', 'specialist', 'array', 'id'));
        } elseif ($role[0]->role_id === 2) { // Customers
            $array = [];
            $score = Score::where('customer_id', '=', $id)->get();
            $citas = DB::Table('citas')->where('user_id', '=', $id)->orderBy('created_at', 'DESC')->get();
            $specialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('status', '=', 1)->get();
            for ($i = 0; $i < count($citas); $i++) {
                $myspecialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('id', '=', $citas[$i]->specialist_id)->get();
                array_push($array, $myspecialist);
            }
            return view('citas.index', compact('citas', 'array', 'specialist', 'score', 'id'));
        } else {
            $array = [];
            $citas = DB::Table('citas')->orderBy('created_at', 'DESC')->get();
            $specialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('status', '=', 1)->get();
            for ($i = 0; $i < count($citas); $i++) {
                $myspecialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('id', '=', $citas[$i]->specialist_id)->get();
                array_push($array, $myspecialist);
            }
            /* for ($i = 0; $i < count($citas); $i++) {
                $paciente = DB::Table('users')->select('id', 'name', 'email')->where('id', '=', $citas[$i]->user_id)->get();
                array_push($array, $paciente);
            } */
            return view('citas.index', compact('citas', 'array', 'specialist', 'id'));
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
        $user_id = Auth::user()->id;

        if (isset($request->action)) {
            $score = Score::create($request);
        }
        $this->validate($request, [
            'specialist_id' => 'required',
            'fecha_cita' => 'required',
            'tipo' => 'required'
        ]);

        $input = $request->all();
        $cita = Citas::create($input);
        $log = [
            "type_log" => "success",
            "user_id" => $user_id,
            "activity" => 'Solicitud de cita',
            "details" => "Solicitud |$cita->id| Correcta"
        ];
        $save = LogUser::create($log);
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
        $user_id = Auth::user()->id;
        $this->validate($request, [
            'id' => 'required',
            'status' => 'required'
        ]);

        $input = $request->all();
        $citas = Citas::find($request->cita);
        $citas->update($input);

        switch ($request->status) {
            case 1:
            case 7:
                $detail = "Cita |$request->id| Aceptada";
                break;
            case 2:
            case 3:
                $detail = "Cita |$request->id| Rechazada";
                break;
            case 4:
            case 5:
            case 6:
                $detail = "Cita |$request->id| Cancelada";
                break;
            case 8:
                $detail = "Cita |$request->id| Realizada";
                break;
        }

        $log = [
            "type_log" => "success",
            "user_id" => $user_id,
            "activity" => 'Actualizacion de cita',
            "details" => $detail
        ];
        $save = LogUser::create($log);

        return redirect()->route('citas.index')
            ->with('success', 'Cita modificada correctamente');
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
