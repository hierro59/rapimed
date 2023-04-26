<?php

namespace App\Http\Controllers;

use App\Models\Specialist;
use App\Models\UserUploadImages;

class DoctorsPublicController extends Controller
{
    public function __invoke()
    {
        $especialistas = Specialist::where('status', '=', 1)->inRandomOrder()->get();

        $data = [];

        for ($i=0; $i < count($especialistas); $i++) {  
            $getAvatar = UserUploadImages::where('customer_id', '=', $especialistas[$i]['user_id'])->where('type', '=', 'avatar')->orderBy('created_at', 'DESC')->get();
            
            (count($getAvatar) >= 1 ? $avatar = $getAvatar[0]['image_name'] : $avatar = "generic-user.png");
                    
            $line = [
                'user_id' => $especialistas[$i]['user_id'],
                'degree' => $especialistas[$i]['degree'],
                'nombre' => $especialistas[$i]['name'],
                'especialidad' => $especialistas[$i]['specialty'],
                'avatar' => $avatar
            ];
            array_push($data, $line);
        }
        
        return view('doctors', compact('data'));
    }
}
