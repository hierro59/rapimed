<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialist;
use App\Models\UserUploadImages;
use App\Models\MetadataUsers;

class WelcomePublicController extends Controller
{
    public function __invoke()
    {
        $especialistas = Specialist::where('status', '=', 1)->inRandomOrder()->limit(12)->get();

        $data = [];

        for ($i=0; $i < count($especialistas); $i++) {  
            $getAvatar = UserUploadImages::where('customer_id', '=', $especialistas[$i]['user_id'])->where('type', '=', 'avatar')->orderBy('created_at', 'DESC')->get();
            $getPortada = UserUploadImages::where('customer_id', '=', $especialistas[$i]['user_id'])->where('type', '=', 'portada')->orderBy('created_at', 'DESC')->get();
            $getMetadata = MetadataUsers::distinct('customer_id')->where('customer_id', '=', $especialistas[$i])->get();

            (count($getAvatar) >= 1 ? $avatar = $getAvatar[0]['image_name'] : $avatar = "generic-user.png");
            (count($getPortada) >= 1 ? $portada = $getPortada[0]['image_name'] : $portada = "generic-portada.jpg");
            
            $line = [
                'user_id' => $especialistas[$i]['user_id'],
                'degree' => $especialistas[$i]['degree'],
                'nombre' => $especialistas[$i]['name'],
                'especialidad' => $especialistas[$i]['specialty'],
                'avatar' => $avatar
            ];
            array_push($data, $line);
        }
        
        return view('welcome', compact('data'));
    }
}
