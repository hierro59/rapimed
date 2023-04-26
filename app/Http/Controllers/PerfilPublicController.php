<?php

namespace App\Http\Controllers;

use App\Models\ScoreCustomer;
use App\Models\Specialist;
use App\Models\MetadataUsers;
use App\Models\Citas;
use Illuminate\Support\Facades\Auth;
use App\Models\UserUploadImages;

class PerfilPublicController extends Controller
{
    public function __invoke($request)
    {
        (isset(Auth::user()->id) ? $user_id = Auth::user()->id : $user_id = false);

        $especialistas = Specialist::where('user_id', '=', $request)->where('status', '=', 1)->get();

        $getAvatar = UserUploadImages::where('customer_id', '=', $especialistas[0]['user_id'])->where('type', '=', 'avatar')->orderBy('created_at', 'DESC')->get();
        $getPortada = UserUploadImages::where('customer_id', '=', $especialistas[0]['user_id'])->where('type', '=', 'portada')->orderBy('created_at', 'DESC')->get();
        $getMetadata = MetadataUsers::distinct('customer_id')->where('customer_id', '=', $especialistas[0]['user_id'])->get();
        $getCitas = Citas::distinct('user_id')->where('specialist_id', '=', $especialistas[0]['id'])->count('user_id');
        $getScore = ScoreCustomer::where('specialist_id', '=', $especialistas[0]['id'])->where('score', ">", 0)->get()->sum('score');

        (count($getAvatar) >= 1 ? $avatar = $getAvatar[0]['image_name'] : $avatar = "generic-user.png");
        (count($getPortada) >= 1 ? $portada = $getPortada[0]['image_name'] : $portada = "generic-portada.jpg");
        if (count($getMetadata) >= 1) {
            if ($getMetadata[0]['sex'] == 1) {
                $genero = 'la-mars';
            } elseif ($getMetadata[0]['sex'] == 2) {
                $genero = 'la-venus';
            } else {
                $genero = 'la-transgender';
            }
        } else {
            $genero = 'la-transgender';
        }

        
        $now = (int)date('Y-m-d'); 
        $nacimiento = (int)$especialistas[0]['dob'];
        $graduacion = (int)$especialistas[0]['dog'];
        
        (count($getMetadata) >= 1 ? $historial = $getMetadata[0]['medical_history'] : $historial = "Breve reseña de habilidades");
        (count($getMetadata) >= 1 ? $direccion = $getMetadata[0]['address'] : $direccion = "Sin datos");
        (count($getMetadata) >= 1 ? $ciudad = $getMetadata[0]['city'] : $ciudad = "Sin datos");
        (count($getMetadata) >= 1 ? $estado = $getMetadata[0]['state'] : $estado = "Sin datos");
        (count($getMetadata) >= 1 ? $pais = $getMetadata[0]['country'] : $pais = "Sin datos");
        (count($getMetadata) >= 1 ? $phone = $getMetadata[0]['phone'] : $phone = "Sin teléfono");
        (isset($especialistas[0]['dob']) ? $dob = $now - $nacimiento : $dob = "Sin datos");
        (isset($especialistas[0]['dog']) ? $dog = $now - $graduacion : $dog = "Sin datos");
        ($especialistas[0]['tc_domicilio'] == 1 ? $tc_domicilio = true : $tc_domicilio = false);
        ($especialistas[0]['tc_virtual'] == 1 ? $tc_virtual = true : $tc_virtual = false);
        ($especialistas[0]['tc_consultorio'] == 1 ? $tc_consultorio = true : $tc_consultorio = false);
        
        $data = [
            'specialist_id' => $especialistas[0]['id'],
            'degree' => $especialistas[0]['degree'],
            'nombre' => $especialistas[0]['name'],
            'especialidad' => $especialistas[0]['specialty'],
            'email' => $especialistas[0]['email'],
            'avatar' => $avatar,
            'portada' => $portada,
            'genero' => $genero,
            'historial' => $especialistas[0]['bio'],
            'direccion' => $direccion,
            'ciudad' => $ciudad,
            'estado' => $estado,
            'pais' => $pais,
            'phone' => $phone,
            'user_id' => $user_id,
            'pacientes' => $getCitas,
            'score' => $getScore,
            'tc_domicilio' => $tc_domicilio,
            'tc_virtual' => $tc_virtual,
            'tc_consultorio' => $tc_consultorio,
            'dob' => $dob,
            'dog' => $dog
        ];

        $otrosespecialistas = Specialist::where('user_id', 'not like', $request)->inRandomOrder()->skip(0)->take(5)->get();

        $otros = [];

        for ($i=0; $i < count($otrosespecialistas); $i++) {  
            $getAvatar = UserUploadImages::where('customer_id', '=', $otrosespecialistas[$i]['user_id'])->where('type', '=', 'avatar')->orderBy('created_at', 'DESC')->get();
            $getMetadata = MetadataUsers::distinct('customer_id')->where('customer_id', '=', $otrosespecialistas[$i])->get();

            (count($getAvatar) >= 1 ? $avatarOtros = $getAvatar[0]['image_name'] : $avatarOtros = "generic-user.png");
            
            $line = [
                'user_id' => $otrosespecialistas[$i]['user_id'],
                'degree' => $otrosespecialistas[$i]['degree'],
                'nombre' => $otrosespecialistas[$i]['name'],
                'especialidad' => $otrosespecialistas[$i]['specialty'],
                'avatar' => $avatarOtros
            ];
            array_push($otros, $line);
        }
        
        return view('perfil', compact('data', 'otros'));
    }
}
