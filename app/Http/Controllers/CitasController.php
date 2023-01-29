<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\Score;
use App\Models\LogUser;
use App\Models\Operation;
use App\Mail\NewCitaEmail;
use App\Models\Specialist;
use Illuminate\Http\Request;
use App\Models\ScoreCustomer;
use App\Mail\AcceptedCitaEmail;
use App\Mail\RejectedCitaEmail;
use App\Mail\CancelledCitaEmail;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
            $datos = [];
            $specialistEmail = Auth::user()->email;
            $specialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('email', '=', $specialistEmail)->get();
            $citas = DB::Table('citas')->where('specialist_id', '=', $specialist[0]->id,)->orderBy('created_at', 'DESC')->get();
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
            return view('citas.index', compact('datos', 'specialist', 'id'));
            /*  $specialistEmail = Auth::user()->email;
            $specialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('email', '=', $specialistEmail)->get();
            $citas = DB::Table('citas')->where('specialist_id', '=', $specialist[0]->id)->get();
            $array = [];
            for ($i = 0; $i < count($citas); $i++) {
                $paciente = DB::Table('users')->select('id', 'name', 'email')->where('id', '=', $citas[$i]->user_id)->get();
                array_push($array, $paciente);
            }
            return view('citas.index', compact('citas', 'specialist', 'array', 'id')); */
        } elseif ($role[0]->role_id === 2) { // Customers
            $datos = [];
            $specialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('status', '=', 1)->get();
            $citas = DB::Table('citas')->where('user_id', '=', $id)->where('status', '!=', 3)->orderBy('created_at', 'DESC')->get();
            $paciente = DB::Table('users')->select('id', 'name', 'email')->where('id', '=', $id)->get();
            for ($i = 0; $i < count($citas); $i++) {
                $myspecialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('id', '=', $citas[$i]->specialist_id)->get();
                $score = Score::where('cita_id', '=', $citas[$i]->id)->get();
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
                        'score' => (isset($score[0]->score) ? $score[0]->score : "NULL"),
                        'score_commit' => (isset($score[0]->commit) ? $score[0]->commit : "Sin opinión."),
                    ];
                array_push($datos, $array);
            }
            /* return view('home', compact('datos', 'specialist', 'id'));
            $array = [];
            for ($i = 0; $i < count($citas); $i++) {
                $paciente = DB::Table('users')->select('id', 'name', 'email')->where('id', '=', $citas[$i]->user_id)->get();
                array_push($array, $paciente);
            } */
            return view('citas.index', compact('citas', 'specialist', 'datos', 'id'));
            /* $array = [];
            $score = Score::where('customer_id', '=', $id)->get();
            $citas = DB::Table('citas')->where('user_id', '=', $id)->orderBy('created_at', 'DESC')->get();
            $specialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('status', '=', 1)->get();
            for ($i = 0; $i < count($citas); $i++) {
                $myspecialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('id', '=', $citas[$i]->specialist_id)->get();
                array_push($array, $myspecialist);
            }
            return view('citas.index', compact('citas', 'array', 'specialist', 'score', 'id')); */
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

        $specialist = DB::Table('specialists')->select('name', 'email', 'degree')->where('id', '=', $request['specialist_id'])->get();

        $objData = new \stdClass();
        $objData->sender = 'RapiMed';
        $objData->receiver = $specialist[0]->name;
        $objData->degree = $specialist[0]->degree;
        $objData->email = $specialist[0]->email;
        $objData->fecha = $request['fecha_cita'];
        $objData->hora = $request['hora_cita'];
        $objData->tipo = $request['tipo'];
        $objData->paciente = Auth::user()->name;
        Mail::to($specialist[0]->email)->send(new NewCitaEmail($objData));

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

                $paciente = User::find($citas->user_id);
                $objData = new \stdClass();
                $objData->sender = 'RapiMed';
                $objData->receiver = $paciente->name;
                $objData->email = $paciente->email;
                $objData->fecha = $citas->fecha_cita;
                $objData->hora = $citas->hora_cita;
                $objData->tipo = $citas->tipo;
                Mail::to($paciente->email)->send(new AcceptedCitaEmail($objData));
                break;
            case 2:
            case 3:
                $detail = "Cita |$request->id| Rechazada";

                $paciente = User::find($citas->user_id);
                $objData = new \stdClass();
                $objData->sender = 'RapiMed';
                $objData->receiver = $paciente->name;
                $objData->email = $paciente->email;
                $objData->fecha = $citas->fecha_cita;
                $objData->hora = $citas->hora_cita;
                $objData->tipo = $citas->tipo;
                Mail::to($paciente->email)->send(new RejectedCitaEmail($objData));
                break;
            case 4:
                $detail = "Cita |$request->id| Cancelada";

                $paciente = User::find($citas->user_id);
                $objData = new \stdClass();
                $objData->sender = 'RapiMed';
                $objData->receiver = $paciente->name;
                $objData->email = $paciente->email;
                $objData->fecha = $citas->fecha_cita;
                $objData->hora = $citas->hora_cita;
                $objData->tipo = $citas->tipo;
                Mail::to($paciente->email)->send(new CancelledCitaEmail($objData));
                break;
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
