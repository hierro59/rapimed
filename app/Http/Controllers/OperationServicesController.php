<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetadataUsers;
use App\Models\Citas;

class OperationServicesController extends Controller
{
    public static function CheckMetadata($id) 
    {
        $getMetadata = MetadataUsers::where('customer_id', '=', $id)->get();
        if (count($getMetadata) >= 1) {
            if ($getMetadata[0]['address'] == 'Sin datos' OR $getMetadata[0]['city'] == 'Sin datos' OR $getMetadata[0]['state'] == 'Sin datos' OR $getMetadata[0]['phone'] == 'Sin teléfono') {
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
    public static function CheckCitas($user_id) 
    {
        $response = [];
        $getCitas = Citas::where('user_id', '=', $user_id)->get();
        if (count($getCitas) > 1) {
            for ($i=0; $i < count($getCitas); $i++) { 

                $fechaCita = explode(" ", $getCitas[$i]['fecha_cita']);
                $horaCita = explode(":", (isset($getCitas[$i]['hora_cita']) == NULL ? '00:00' : $getCitas[$i]['hora_cita']));

                $fechaCompuestaCita = $fechaCita[0] . " " . $getCitas[$i]['hora_cita'] . ":00";
                $horaMenos10 = date('Y-m-d H:i:s', strtotime('-10 minute' , strtotime($fechaCompuestaCita)));
                $fechaMasUnaHora = date('Y-m-d H:i:s', strtotime('+60 minute' , strtotime($fechaCompuestaCita)));
                
                $menosundia = date('Y-m-d H:i:s', strtotime('-1 day', strtotime($fechaCompuestaCita)));
                
                $fechaActual = date('Y-m-d H:i:s');
                $minutoActual = date('i');
                $minutoCita = $horaCita[1];

                logger('-------------------');
                /* logger($fechaActual);
                logger($horaMenos10); */

                if ($fechaActual >= $horaMenos10 && $fechaActual <= $fechaCompuestaCita) {
                    $minRestantes = (int)$minutoCita - (int)$minutoActual;
                    logger($minutoActual);
                    logger($minutoCita);
                    $array = [
                        'titulo' => 'Cita por iniciar',
                        'detalle' => 'Su cita #' . $getCitas[$i]['id'] . ' inciará en ' . $minRestantes . ' minutos',
                        'tipo' => 'info',
                        'fecha' => $fechaCompuestaCita,
                        'cita_id' => $getCitas[$i]['id'],
                        'tipo_cita' => (isset($getCitas[$i]['tipo']) ? $getCitas[$i]['tipo'] : "")
                    ];
                    array_push($response, $array);
                }
                /* if (date('Y-m-d', strtotime($fechaCita[0])) >= date('Y-m-d')) {
                    $array = [
                        'titulo' => 'Cita ya inicio',
                        'detalle' => 'La cita esta en curso',
                        'tipo' => 'info',
                        'fecha' => $fechaCompuestaCita,
                        'cita_id' => $getCitas[$i]['id']
                    ];
                    array_push($response, $array);
                } */
            }
        }/*  else {
            $array = [
                'titulo' => 'No hay citas',
                'detalle' => 'So ne encronto nada',
                'tipo' => 'info'
            ];
            array_push($response, $array);
        } */
        //logger(json_encode($response));
        return $response;
    }
}
