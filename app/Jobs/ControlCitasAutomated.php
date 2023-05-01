<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Citas;
use App\Models\NotificationsControlCitas;

class ControlCitasAutomated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = [];
        $getCitas = Citas::get();
        if (count($getCitas) > 1) {
            for ($i=0; $i < count($getCitas); $i++) { 

                $ncc = NotificationsControlCitas::find($getCitas[$i]['id']);

                $ncc_menos_diez = NULL;
                $ncc_menos_cinco = NULL;
                $ncc_menos_un_dia = NULL;
                $ncc_inicio = NULL;
                $ncc_created_at = NULL;
                $ncc_updated_at = NULL;

                if (count($ncc) > 1) {
                    $ncc_menos_diez = $ncc[0]['ncc_menos_diez'];
                    $ncc_menos_cinco = $ncc[0]['ncc_menos_cinco'];
                    $ncc_menos_un_dia = $ncc[0]['ncc_menos_un_dia'];
                    $ncc_inicio = $ncc[0]['ncc_inicio'];
                    $ncc_created_at = $ncc[0]['ncc_created_at'];
                    $ncc_updated_at = $ncc[0]['ncc_updated_at'];
                }

                $fechaCita = explode(" ", $getCitas[$i]['fecha_cita']);
                $horaCita = explode(":", $getCitas[$i]['hora_cita']);

                $fechaCompuestaCita = $fechaCita[0] . " " . $getCitas[$i]['hora_cita'] . ":00";
                $horaMenos10 = date('Y-m-d H:i:s', strtotime('-10 minute' , strtotime($fechaCompuestaCita)));
                $fechaMasUnaHora = date('Y-m-d H:i:s', strtotime('+60 minute' , strtotime($fechaCompuestaCita)));
                
                $menosundia = date('Y-m-d H:i:s', strtotime('-1 day', strtotime($fechaCompuestaCita)));
                
                $fechaActual = date('Y-m-d H:i:s');
                $minutoActual = date('i');
                $minutoCita = $horaCita[1];

                logger('-------------------');

                if ($fechaActual >= $horaMenos10 && $fechaActual <= $fechaCompuestaCita && $ncc_menos_diez == NULL) {
                    $minRestantes = (int)$minutoCita - (int)$minutoActual;
                    $array = [
                        'titulo' => 'Cita por iniciar',
                        'detalle' => 'Su cita #' . $getCitas[$i]['id'] . ' inciará en ' . $minRestantes . ' minutos',
                        'tipo' => 'info',
                        'fecha' => $fechaCompuestaCita,
                        'cita_id' => $getCitas[$i]['id'],
                        'tipo_cita' => $getCitas[$i]['tipo']
                    ];
                    array_push($response, $array);
                    logger(json_encode($response));
                }
            }
        } else {
            $array = [
                'titulo' => 'No hay citas',
                'detalle' => 'So ne encronto nada',
                'tipo' => 'info'
            ];
            array_push($response, $array);
        }
        //logger(json_encode($response));
    }
}
