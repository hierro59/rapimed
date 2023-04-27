<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\ScoreCustomer;
use App\Models\Score;
use App\Models\User;
use App\Models\UserUploadImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\MetadataUsers;

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
        function CheckMetadata($id) {
            $getMetadata = MetadataUsers::where('customer_id', '=', $id)->get();
            if ($getMetadata[0]['address'] == 'Sin datos' OR $getMetadata[0]['city'] == 'Sin datos' OR $getMetadata[0]['state'] == 'Sin datos' OR $getMetadata[0]['country'] == 'Sin datos' OR $getMetadata[0]['phone'] == 'Sin teléfono') {
                return true;
            } else {
                return false;
            }
        }

        $id = Auth::user()->id;

        $completedMetadata = CheckMetadata($id);

        $role = DB::Table('model_has_roles')->where('model_id', '=', $id)->get();
        $notificaciones = Notification::where('to_id', $id)->get();
        if ($role[0]->role_id === 3) { // Especialista
            $datos = [];
            $specialistEmail = Auth::user()->email;
            $specialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty', 'user_id')->where('email', '=', $specialistEmail)->get();
            $citas = DB::Table('citas')->where('specialist_id', '=', $specialist[0]->id,)->orderBy('created_at', 'DESC')->limit(5)->get();
            for ($i = 0; $i < count($citas); $i++) {
                $myspecialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty', 'user_id')->where('id', '=', $citas[$i]->specialist_id)->get();
                $paciente = DB::Table('users')->select('id', 'name', 'email')->where('id', '=', $citas[$i]->user_id)->get();
                $score = Score::where('cita_id', '=', $citas[$i]->id)->get();
                $score_customers = ScoreCustomer::where('cita_id', '=', $citas[$i]->id)->get();
                $getAvatar = UserUploadImages::where('customer_id', '=', $citas[$i]->user_id)->where('type', '=', 'avatar')->get();
                (count($getAvatar) >= 1 ? $avatar = $getAvatar[0]['image_name'] : $avatar = "generic-user.png");
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
                        'paciente_avatar' => $avatar,
                        'score_customers' => (isset($score_customers[0]->score) ? $score_customers[0]->score : NULL),
                        'score_customers_commit' => (isset($score_customers[0]->commit) ? $score_customers[0]->commit : "Sin opinión."),
                        'score_customers_date' => (isset($score_customers[0]->created_at) ? $score_customers[0]->created_at : NULL),
                        'score' => (isset($score[0]->score) ? $score[0]->score : NULL),
                        'role' => 'Especialista'
                    ];
                array_push($datos, $array);
            }
            return view('home', compact('datos', 'specialist', 'id', 'notificaciones', 'completedMetadata'));
        } elseif ($role[0]->role_id === 2) { //Customer
            $datos = [];
            $specialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('status', '=', 1)->get();
            $citas = DB::Table('citas')->where('user_id', '=', $id)->orderBy('created_at', 'DESC')->get();
            $paciente = DB::Table('users')->select('id', 'name', 'email')->where('id', '=', $id)->get();
            for ($i = 0; $i < count($citas); $i++) {
                $myspecialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty', 'user_id')->where('id', '=', $citas[$i]->specialist_id)->get();
                $score = Score::where('cita_id', '=', $citas[$i]->id)->get();
                $score_customers = ScoreCustomer::where('cita_id', '=', $citas[$i]->id)->get();
                $getAvatar = UserUploadImages::where('customer_id', '=', $myspecialist[0]->user_id)->where('type', '=', 'avatar')->get();
                (count($getAvatar) >= 1 ? $avatar = $getAvatar[0]['image_name'] : $avatar = "generic-user.png");
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
                        'paciente_avatar' => $avatar,
                        'score_customers' => (isset($score_customers[0]->score) ? $score_customers[0]->score : NULL),
                        'score_customers_commit' => (isset($score_customers[0]->commit) ? $score_customers[0]->commit : "Sin opinión."),
                        'score_customers_date' => (isset($score_customers[0]->created_at) ? $score_customers[0]->created_at : NULL),
                        'score' => (isset($score[0]->score) ? $score[0]->score : NULL),
                        'role' => 'Customer'
                    ];
                array_push($datos, $array);
            }
            return view('home', compact('citas', 'specialist', 'datos', 'id', 'notificaciones', 'completedMetadata'));
        } else { //SuperAdmin
            $datos = [];
            $citas = DB::Table('citas')->orderBy('created_at', 'DESC')->limit(20)->get();
            $specialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty', 'user_id')->where('status', '=', 1)->get();
            $customers = User::where('status', '=', '1')->count('id');
            $countSpecialist = count($specialist);
            $numCustomers = $customers - $countSpecialist;
            for ($i = 0; $i < count($citas); $i++) {
                $myspecialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty', 'user_id')->where('id', '=', $citas[$i]->specialist_id)->get();
                $paciente = DB::Table('users')->select('id', 'name', 'email')->where('id', '=', $citas[$i]->user_id)->get();
                $getAvatar = UserUploadImages::where('customer_id', '=', $myspecialist[0]->user_id)->where('type', '=', 'avatar')->get();
                $score = Score::where('cita_id', '=', $citas[$i]->id)->get();
                
                (count($getAvatar) >= 1 ? $avatar = $getAvatar[0]['image_name'] : $avatar = "generic-user.png");
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
                        'paciente_avatar' => $avatar,
                        'role' => 'SuperAdmin'
                    ];
                array_push($datos, $array);
            }
            $score_customers = [];
            $get_score_customers = ScoreCustomer::where('status', '=', 1)->limit(20)->get();
            for ($j = 0; $j < count($get_score_customers); $j++) {
                $get_specialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty', 'user_id')->where('id', '=', $get_score_customers[$j]->specialist_id)->get();
                $paciente = DB::Table('users')->select('id', 'name', 'email')->where('id', '=', $get_score_customers[$j]->customer_id)->get();
                $getAvatarCustomer = UserUploadImages::where('customer_id', '=', $get_score_customers[0]->customer_id)->where('type', '=', 'avatar')->get();
                $getAvatarSpecialist = UserUploadImages::where('customer_id', '=', $get_specialist[0]->user_id)->where('type', '=', 'avatar')->get();
                 
                (count($getAvatarCustomer) >= 1 ? $avatarCustomer = $getAvatarCustomer[0]['image_name'] : $avatarCustomer = "generic-user.png");
                (count($getAvatarSpecialist) >= 1 ? $avatarSpecialist = $getAvatarSpecialist[0]['image_name'] : $avatarSpecialist = "generic-user.png");
                $array2 =
                    [
                        'cita_id' => $get_score_customers[$j]->id,
                        'specialist_id' => $get_specialist[0]->id,
                        'specialist_user_id' => $get_specialist[0]->user_id,
                        'specialist_name' => $get_specialist[0]->name,
                        'specialist_degree' => $get_specialist[0]->degree,
                        'specialist_specialty' => $get_specialist[0]->specialty,
                        'specialist_avatar' => $avatarSpecialist,
                        'paciente_id' => $paciente[0]->id,
                        'paciente_name' => $paciente[0]->name,
                        'paciente_avatar' => $avatarCustomer,
                        'score_customers' => (isset($get_score_customers[$j]->score) ? $get_score_customers[$j]->score : NULL),
                        'score_customers_commit' => (isset($get_score_customers[$j]->commit) ? $get_score_customers[$j]->commit : "Sin opinión."),
                        'score_customers_date' => (isset($get_score_customers[$j]->created_at) ? $get_score_customers[$j]->created_at : NULL),
                        'score' => (isset($score[0]->score) ? $score[0]->score : NULL),
                        'role' => 'SuperAdmin'
                    ];
                array_push($score_customers, $array2);
            }
            $role = 'SuperAdmin';
            return view('home', compact('datos', 'specialist', 'id', 'notificaciones', 'numCustomers', 'countSpecialist', 'score_customers', 'role', 'completedMetadata'));
        }
    }
}
