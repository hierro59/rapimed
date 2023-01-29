<?php

namespace App\Http\Controllers;

use App\Models\ScoreCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::user()->id;
        $role = DB::Table('model_has_roles')->where('model_id', '=', $id)->get();
        if ($role[0]->role_id === 3) { // Especialista
            $datos = [];
            $specialistEmail = Auth::user()->email;
            $specialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('email', '=', $specialistEmail)->get();
            $citas = DB::Table('citas')->where('specialist_id', '=', $specialist[0]->id,)->where('status', '!=', 8)->where('status', '!=', 3)->where('status', '!=', 2)->orderBy('created_at', 'DESC')->get();
            for ($i = 0; $i < count($citas); $i++) {
                $myspecialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('id', '=', $citas[$i]->specialist_id)->get();
                $paciente = DB::Table('users')->select('id', 'name', 'email')->where('id', '=', $citas[$i]->user_id)->get();
                $score_customers = ScoreCustomer::where('cita_id', '=', $citas[$i]->id)->get();
                $array =
                    [
                        'cita_id' => $citas[$i]->id,
                        'cita_fecha' => $citas[$i]->fecha_cita,
                        'cita_hora' => $citas[$i]->hora_cita,
                        'cita_tipo' => $citas[$i]->tipo,
                        'cita_status' => $citas[$i]->status,
                        'specialist_id' => $specialist[0]->id,
                        'specialist_name' => $specialist[0]->name,
                        'specialist_email' => $specialist[0]->email,
                        'specialist_degree' => $specialist[0]->degree,
                        'specialist_specialty' => $specialist[0]->specialty,
                        'paciente_id' => $paciente[0]->id,
                        'paciente_name' => $paciente[0]->name,
                        'score_customers' => (isset($score_customers[0]->score) ? $score_customers[0]->score : "NULL"),
                        'score_customers_commit' => (isset($score_customers[0]->commit) ? $score_customers[0]->commit : "Sin opinión."),
                    ];
                array_push($datos, $array);
            }
            return view('home', compact('datos', 'specialist', 'id'));
            //$array = [];
            /*  for ($i = 0; $i < count($citas); $i++) {
                $paciente = DB::Table('users')->select('id', 'name', 'email')->where('id', '=', $citas[$i]->user_id)->get();
                array_push($array, $paciente);
            }
            return view('home', compact('citas', 'specialist', 'array', 'id')); */
        } elseif ($role[0]->role_id === 2) { //Customer
            $datos = [];
            $specialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('status', '=', 1)->get();
            $citas = DB::Table('citas')->where('user_id', '=', $id)->where('status', '!=', 8)->where('status', '!=', 2)->where('status', '!=', 3)->orderBy('created_at', 'DESC')->get();
            $paciente = DB::Table('users')->select('id', 'name', 'email')->where('id', '=', $id)->get();
            for ($i = 0; $i < count($citas); $i++) {
                $myspecialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('id', '=', $citas[$i]->specialist_id)->get();
                $array =
                    [
                        'cita_id' => $citas[$i]->id,
                        'cita_fecha' => $citas[$i]->fecha_cita,
                        'cita_hora' => $citas[$i]->hora_cita,
                        'cita_tipo' => $citas[$i]->tipo,
                        'cita_status' => $citas[$i]->status,
                        'specialist_id' => $myspecialist[0]->id,
                        'specialist_name' => $myspecialist[0]->name,
                        'specialist_email' => $myspecialist[0]->email,
                        'specialist_degree' => $myspecialist[0]->degree,
                        'specialist_specialty' => $myspecialist[0]->specialty,
                        'paciente_id' => $paciente[0]->id,
                        'paciente_name' => $paciente[0]->name,
                    ];
                array_push($datos, $array);
            }
            /* return view('home', compact('datos', 'specialist', 'id'));
            $array = [];
            for ($i = 0; $i < count($citas); $i++) {
                $paciente = DB::Table('users')->select('id', 'name', 'email')->where('id', '=', $citas[$i]->user_id)->get();
                array_push($array, $paciente);
            } */
            return view('home', compact('citas', 'specialist', 'datos', 'id'));
        } else { //SuperAdmin
            $datos = [];
            $citas = DB::Table('citas')->orderBy('created_at', 'DESC')->get();
            $specialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('status', '=', 1)->get();
            for ($i = 0; $i < count($citas); $i++) {
                $myspecialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('id', '=', $citas[$i]->specialist_id)->get();
                $paciente = DB::Table('users')->select('id', 'name', 'email')->where('id', '=', $citas[$i]->user_id)->get();
                $array =
                    [
                        'cita_id' => $citas[$i]->id,
                        'cita_fecha' => $citas[$i]->fecha_cita,
                        'cita_hora' => $citas[$i]->hora_cita,
                        'cita_tipo' => $citas[$i]->tipo,
                        'cita_status' => $citas[$i]->status,
                        'specialist_id' => $myspecialist[0]->id,
                        'specialist_name' => $myspecialist[0]->name,
                        'specialist_email' => $myspecialist[0]->email,
                        'specialist_degree' => $myspecialist[0]->degree,
                        'specialist_specialty' => $myspecialist[0]->specialty,
                        'paciente_name' => $paciente[0]->name,
                    ];
                array_push($datos, $array);
            }
            return view('home', compact('datos', 'specialist', 'id'));
        }
        /* $id = Auth::user()->id;
        $specialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('status', '=', 1)->get();
        return view('home', compact('specialist', 'id')); */
    }
}
