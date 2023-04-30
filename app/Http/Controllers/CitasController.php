<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\Score;
use App\Models\LogUser;
use App\Models\Operation;
use App\Mail\NewCitaEmail;
use App\Models\Specialist;
use Exception;
use Illuminate\Http\Request;
use App\Models\ScoreCustomer;
use App\Mail\AcceptedCitaEmail;
use App\Mail\RejectedCitaEmail;
use App\Mail\CancelledCitaEmail;
use App\Mail\ReprogramadaCitaEmail;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Notification;
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
        $notificaciones = Notification::where('to_id', $id)->get();
        if ($role[0]->role_id === 3) { // Especialistas
            $datos = [];
            $specialistEmail = Auth::user()->email;
            $specialist = DB::Table('specialists')->select('id', 'user_id', 'name', 'email', 'degree', 'specialty')->where('email', '=', $specialistEmail)->get();
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
                        'specialist_user_id' => $specialist[0]->user_id,
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
            return view('citas.index', compact('datos', 'specialist', 'id', 'notificaciones'));
        } elseif ($role[0]->role_id === 2) { // Customers
            $datos = [];
            $specialist = DB::Table('specialists')->select('id', 'user_id', 'name', 'email', 'degree', 'specialty')->where('status', '=', 1)->get();
            $citas = DB::Table('citas')->where('user_id', '=', $id)->where('status', '!=', 3)->orderBy('created_at', 'DESC')->get();
            $paciente = DB::Table('users')->select('id', 'name', 'email')->where('id', '=', $id)->get();
            for ($i = 0; $i < count($citas); $i++) {
                $myspecialist = DB::Table('specialists')->select('id', 'user_id', 'name', 'email', 'degree', 'specialty')->where('id', '=', $citas[$i]->specialist_id)->get();
                $score = Score::where('cita_id', '=', $citas[$i]->id)->get();
                $array =
                    [
                        'cita_id' => $citas[$i]->id,
                        'cita_fecha' => $citas[$i]->fecha_cita,
                        'cita_hora' => $citas[$i]->hora_cita,
                        'cita_tipo' => $citas[$i]->tipo,
                        'cita_status' => $citas[$i]->status,
                        'specialist_id' => $myspecialist[0]->id,
                        'specialist_user_id' => $myspecialist[0]->user_id,
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
            return view('citas.index', compact('citas', 'specialist', 'datos', 'id', 'notificaciones'));
        } elseif ($role[0]->role_id === 1) { // SuperAdmin
            $datos = [];
            $specialist = DB::Table('specialists')->select('id', 'user_id', 'name', 'email', 'degree', 'specialty')->where('status', '=', 1)->get();
            $citas = DB::Table('citas')->orderBy('created_at', 'DESC')->get();
            $paciente = DB::Table('users')->select('id', 'name', 'email')->where('id', '=', $id)->get();
            for ($i = 0; $i < count($citas); $i++) {
                $myspecialist = DB::Table('specialists')->select('id', 'user_id', 'name', 'email', 'degree', 'specialty')->where('id', '=', $citas[$i]->specialist_id)->get();
                $score = Score::where('cita_id', '=', $citas[$i]->id)->get();
                $array =
                    [
                        'cita_id' => $citas[$i]->id,
                        'cita_fecha' => $citas[$i]->fecha_cita,
                        'cita_hora' => $citas[$i]->hora_cita,
                        'cita_tipo' => $citas[$i]->tipo,
                        'cita_status' => $citas[$i]->status,
                        'specialist_id' => $myspecialist[0]->id,
                        'specialist_user_id' => $myspecialist[0]->user_id,
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
            return view('citas.index', compact('citas', 'specialist', 'datos', 'id', 'notificaciones'));
        } else {
            $datos = [];
            $specialist = DB::Table('specialists')->select('id', 'user_id', 'name', 'email', 'degree', 'specialty')->where('status', '=', 1)->get();
            $citas = DB::Table('citas')->orderBy('created_at', 'DESC')->get();
            
            for ($i = 0; $i < count($citas); $i++) {
                $myspecialist = DB::Table('specialists')->select('id', 'user_id', 'name', 'email', 'degree', 'specialty')->where('id', '=', $citas[$i]->specialist_id)->get();
                $score = Score::where('cita_id', '=', $citas[$i]->id)->get();
                $paciente = DB::Table('users')->select('id', 'name', 'email')->where('id', '=', $citas[$i]->user_id)->get();
                $array =
                    [
                        'cita_id' => $citas[$i]->id,
                        'cita_fecha' => $citas[$i]->fecha_cita,
                        'cita_hora' => $citas[$i]->hora_cita,
                        'cita_tipo' => $citas[$i]->tipo,
                        'cita_status' => $citas[$i]->status,
                        'specialist_id' => $myspecialist[0]->id,
                        'specialist_user_id' => $myspecialist[0]->user_id,
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
            return view('citas.index', compact('citas', 'specialist', 'datos', 'id', 'notificaciones'));
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
        //logger($request);
        $user_id = Auth::user()->id;
        $patient_name = Auth::user()->name;

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

        $specialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree')->where('id', '=', $request['specialist_id'])->get();

        (isset($request['email']) ? $paciente = $request['nombre'] : $paciente = Auth::user()->name);

        $objData = new \stdClass();
        $objData->sender = 'RapiMed';
        $objData->receiver = $specialist[0]->name;
        $objData->degree = $specialist[0]->degree;
        $objData->email = $specialist[0]->email;
        $objData->fecha = $request['fecha_cita'];
        $objData->hora = $request['hora_cita'];
        $objData->tipo = $request['tipo'];
        $objData->paciente = $paciente;
        Mail::to($specialist[0]->email)->send(new NewCitaEmail($objData));

        $log = [
            "type_log" => "success",
            "user_id" => $user_id,
            "activity" => 'Solicitud de cita',
            "details" => "Solicitud |$cita->id| Correcta"
        ];
        $save = LogUser::create($log);

        $datosNotificacion = [
            "to_id" => (int)$request['specialist_id'],
            "data" => json_encode([
                "titulo" => "Solicitud de consulta.",
                "detalle" => "El paciente $patient_name ha solicitado una cita con usted.",
                "tipo" => $request['tipo'],
                "id_cita" => $cita->id
            ])
        ];
        Notification::create($datosNotificacion);

        return redirect()->route('citas.index')
            ->with('success', 'Cita creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auth_id = Auth::user()->id;
        $notificaciones = Notification::where('to_id', $auth_id)->get();
        $cita = Citas::find($id);
        $especialista = Specialist::find($cita->specialist_id);
        $paciente = User::find($cita->user_id);
        return view('citas.edit', compact('cita', 'especialista', 'paciente', 'notificaciones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $auth_id = Auth::user()->id;
        $notificaciones = Notification::where('to_id', $auth_id)->get();
        $cita = Citas::find($id);
        $especialista = Specialist::find($cita->specialist_id);
        $paciente = User::find($cita->user_id);

        return view('citas.edit', compact('cita', 'especialista', 'paciente', 'notificaciones'));

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

        if (isset($request->accion) == 'reprogramar') {
            $paciente = User::find($citas->user_id);
            $objData = new \stdClass();
            $objData->sender = 'RapiMed';
            $objData->receiver = $paciente->name;
            $objData->email = $paciente->email;
            $objData->especialista = $request->especialista;
            $objData->fecha = $citas->fecha_cita;
            $objData->hora = $citas->hora_cita;
            $objData->tipo = $citas->tipo;
            try {
                Mail::to($paciente->email)->send(new ReprogramadaCitaEmail($objData));
            } catch (Exception $e) {
                logger($e);
            }
        }

        switch ($request->status) {
            case 0:
            case 1:
            case 7:
                if (isset($request->accion) == 'reprogramar') {
                    $title = "Solicitud de cita";
                    $detail = "Cita |$request->id| Reprogramada";
                } else {
                    $title = "Solicitud de cita";
                    $detail = "Cita |$request->id| Aceptada";
                    $paciente = User::find($citas->user_id);
                    $objData = new \stdClass();
                    $objData->sender = 'RapiMed';
                    $objData->receiver = $paciente->name;
                    $objData->email = $paciente->email;
                    $objData->fecha = $citas->fecha_cita;
                    $objData->hora = $citas->hora_cita;
                    $objData->tipo = $citas->tipo;
                    try {
                        Mail::to($paciente->email)->send(new AcceptedCitaEmail($objData));
                    } catch (Exception $e) {
                        logger($e);
                    }
                }
                break;
            case 2:
            case 3:
                $title = "Solicitud de cita";
                $detail = "Cita |$request->id| Rechazada";

                $paciente = User::find($citas->user_id);
                $objData = new \stdClass();
                $objData->sender = 'RapiMed';
                $objData->receiver = $paciente->name;
                $objData->email = $paciente->email;
                $objData->fecha = $citas->fecha_cita;
                $objData->hora = $citas->hora_cita;
                $objData->tipo = $citas->tipo;
                try {
                    Mail::to($paciente->email)->send(new RejectedCitaEmail($objData));
                } catch (Exception $e) {
                    logger($e);
                }
                break;
            case 4:
                $title = "Solicitud de cita";
                $detail = "Cita |$request->id| Cancelada";

                $paciente = User::find($citas->user_id);
                $objData = new \stdClass();
                $objData->sender = 'RapiMed';
                $objData->receiver = $paciente->name;
                $objData->email = $paciente->email;
                $objData->fecha = $citas->fecha_cita;
                $objData->hora = $citas->hora_cita;
                $objData->tipo = $citas->tipo;
                try {
                    Mail::to($paciente->email)->send(new CancelledCitaEmail($objData));
                } catch (Exception $e) {
                    logger($e);
                }
                break;
            case 5:
            case 6:
                $title = "Solicitud de cita";
                $detail = "Cita |$request->id| Cancelada";
                break;
            case 8:
                $title = "Solicitud de cita";
                $detail = "Cita |$request->id| Realizada";
                break;
        }
        $datosNotificacion = [
            "to_id" => $citas->user_id,
            "data" => json_encode([
                "titulo" => $title,
                "detalle" => $detail,
                "tipo" => $citas->tipo,
                "id_cita" => $citas->id
            ])
        ];
        Notification::create($datosNotificacion);

        $log = [
            "type_log" => "success",
            "user_id" => $user_id,
            "activity" => 'Actualizacion de cita',
            "details" => $detail
        ];
        LogUser::create($log);

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
