<?php

namespace App\Console\Commands;

use App\Models\ScoreCustomer;
use Illuminate\Console\Command;
use App\Models\Citas;
use App\Models\User;
use App\Models\Specialist;
use App\Models\NotificationsControlCitas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\CheckMetadataEmail;
use Exception;
use App\Mail\RecordatorioCita;

class ControlCitasAutomated extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:controlcitas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = [];
        $getCitas = Citas::where('status', '=', 1)->orWhere('status', '=', 7)->get();
        
        if (count($getCitas) > 0) {
            for ($i=0; $i < count($getCitas); $i++) { 

                $paciente = User::find($getCitas[$i]['user_id']);
                $especialista = User::find($getCitas[$i]['specialist_id']);

                $ncc = NotificationsControlCitas::where('ncc_cita_id', '=', $getCitas[$i]['id'])->get();
                
                $ncc_menos_diez = (count($ncc) >= 1) ? $ncc[0]['ncc_menos_diez'] : NULL;
                $ncc_menos_cinco = (count($ncc) >= 1) ? $ncc[0]['ncc_menos_cinco'] : NULL;
                $ncc_menos_un_dia = (count($ncc) >= 1) ? $ncc[0]['ncc_menos_un_dia'] : NULL;
                $ncc_mas_un_dia = (count($ncc) >= 1) ? $ncc[0]['ncc_mas_un_dia'] : NULL;
                $ncc_inicio = (count($ncc) >= 1) ? $ncc[0]['ncc_inicio'] : NULL;

                $fechaCita = explode(" ", $getCitas[$i]['fecha_cita']);
                $horaCita = explode(":", (isset($getCitas[$i]['hora_cita']) == NULL ? '00:00' : $getCitas[$i]['hora_cita']));

                $fechaCompuestaCita = $fechaCita[0] . " " . $getCitas[$i]['hora_cita'] . ":00";
                $horaMenos10 = date('Y-m-d H:i:s', strtotime('-10 minute' , strtotime($fechaCompuestaCita)));
                $horaMenos5 = date('Y-m-d H:i:s', strtotime('-5 minute' , strtotime($fechaCompuestaCita)));
                $fechaMasUnaHora = date('Y-m-d H:i:s', strtotime('+60 minute' , strtotime($fechaCompuestaCita)));

                $masundia = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($fechaCompuestaCita)));
                
                $menosundia = date('Y-m-d H:i:s', strtotime('-1 day', strtotime($fechaCompuestaCita)));
                
                $fechaActual = date('Y-m-d H:i:s');
                $minutoActual = date('i');
                $minutoCita = $horaCita[1];

                logger('-------------------');
                logger($getCitas[$i]['id']);
                logger($fechaCompuestaCita);
                logger($masundia);

                /**
                 * Chequea citas que le faltan 10 minutos para inicar
                 */

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
                    $saveDB = [
                        'ncc_cita_id' => $getCitas[$i]['id'],
                        'ncc_menos_diez' => 1,
                        'created_at' => $fechaActual,
                        'updated_at' => $fechaActual
                    ];
                    DB::table('notifications_control_citas')->insert($saveDB);
                    try {
                        $objData = new \stdClass();
                        $objData->sender = 'RapiMed';
                        $objData->paciente = $paciente->name;
                        $objData->email = $paciente->email;
                        $objData->especialistaDegree = $especialista->degree;
                        $objData->especialistaNombre = $especialista->name;
                        $objData->detalle = 'Su cita #' . $getCitas[$i]['id'] . ' inciará en ' . $minRestantes . ' minutos';
                        $objData->citaId = $getCitas[$i]['id'];
                        $objData->fecha = $fechaCita[0];
                        $objData->hora = $getCitas[$i]['hora_cita'];
                        $objData->tipo = $getCitas[$i]['tipo'];
                        Mail::to($paciente->email)->send(new RecordatorioCita($objData));
                        Mail::to($especialista->email)->send(new RecordatorioCita($objData));
                    } catch (Exception $e) {
                        logger($e);
                    }
                    logger(json_encode($response));
                }

                /**
                 * Chequea citas que le faltan 5 minutos para inicar
                 */

                 if ($fechaActual >= $horaMenos5 && $fechaActual <= $fechaCompuestaCita && $ncc_menos_cinco == NULL) {
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
                    
                    if (count($ncc) >= 1) {
                        $saveDB = [
                            'ncc_menos_cinco' => 1,
                            'updated_at' => $fechaActual
                        ];
                        DB::table('notifications_control_citas')->where('id', '=', $ncc[0]['id'])->update($saveDB);
                    } elseif (count($ncc) == 0) {
                        $saveDB = [
                            'ncc_cita_id' => $getCitas[$i]['id'],
                            'ncc_menos_diez' => 1,
                            'ncc_menos_cinco' => 1,
                            'created_at' => $fechaActual,
                            'updated_at' => $fechaActual
                        ];
                        DB::table('notifications_control_citas')->insert($saveDB);
                    }
                    try {
                        $objData = new \stdClass();
                        $objData->sender = 'RapiMed';
                        $objData->paciente = $paciente->name;
                        $objData->email = $paciente->email;
                        $objData->especialistaDegree = $especialista->degree;
                        $objData->especialistaNombre = $especialista->name;
                        $objData->detalle = 'Su cita #' . $getCitas[$i]['id'] . ' inciará en ' . $minRestantes . ' minutos';
                        $objData->citaId = $getCitas[$i]['id'];
                        $objData->fecha = $fechaCita[0];
                        $objData->hora = $getCitas[$i]['hora_cita'];
                        $objData->tipo = $getCitas[$i]['tipo'];
                        Mail::to($paciente->email)->send(new RecordatorioCita($objData));
                        Mail::to($especialista->email)->send(new RecordatorioCita($objData));
                    } catch (Exception $e) {
                        logger($e);
                    }
                    logger(json_encode($response));
                }

                /**
                 * Chequea citas que Iniciaron
                 */

                if ($fechaActual >= $fechaCompuestaCita && $ncc_inicio == NULL) {
                    $minRestantes = (int)$minutoCita - (int)$minutoActual;
                    $array = [
                        'titulo' => 'Cita Iniciada',
                        'detalle' => 'Su cita #' . $getCitas[$i]['id'] . ' ha iniciado',
                        'tipo' => 'info',
                        'fecha' => $fechaCompuestaCita,
                        'cita_id' => $getCitas[$i]['id'],
                        'tipo_cita' => $getCitas[$i]['tipo']
                    ];
                    array_push($response, $array);
                    
                    if (count($ncc) >= 1) {
                        $saveDB = [
                            'ncc_inicio' => 1,
                            'updated_at' => $fechaActual
                        ];
                        DB::table('notifications_control_citas')->where('id', '=', $ncc[0]['id'])->update($saveDB);
                    } elseif (count($ncc) == 0) {
                        $saveDB = [
                            'ncc_cita_id' => $getCitas[$i]['id'],
                            'ncc_menos_diez' => 1,
                            'ncc_menos_cinco' => 1,
                            'ncc_inicio' => 1,
                            'created_at' => $fechaActual,
                            'updated_at' => $fechaActual
                        ];
                        DB::table('notifications_control_citas')->insert($saveDB);
                    }
                    try {
                        $objData = new \stdClass();
                        $objData->sender = 'RapiMed';
                        $objData->paciente = $paciente->name;
                        $objData->email = $paciente->email;
                        $objData->especialistaDegree = $especialista->degree;
                        $objData->especialistaNombre = $especialista->name;
                        $objData->detalle = '¡Ya es la hora! Su cita #' . $getCitas[$i]['id'] . ' inició.';
                        $objData->citaId = $getCitas[$i]['id'];
                        $objData->fecha = $fechaCita[0];
                        $objData->hora = $getCitas[$i]['hora_cita'];
                        $objData->tipo = $getCitas[$i]['tipo'];
                        Mail::to($paciente->email)->send(new RecordatorioCita($objData));
                        Mail::to($especialista->email)->send(new RecordatorioCita($objData));
                    } catch (Exception $e) {
                        logger($e);
                    }
                    logger(json_encode($response));
                }

                /**
                 * Chequea citas que termiaron hace un dia y no han calificado
                 */

                if ($fechaActual >= $masundia && $ncc_mas_un_dia == NULL) {
                    $score = ScoreCustomer::where('cita_id', '=', $getCitas[$i]['id'])->get();
                    
                    if (count($score) <= 0) {
                        $minRestantes = (int)$minutoCita - (int)$minutoActual;
                        $array = [
                            'titulo' => 'Calificar',
                            'detalle' => 'Su cita #' . $getCitas[$i]['id'] . ' se realizó ayer y notamos que aún no ha calificado su experiencia. Le recordamos que para nosotros su opinión es muy importante y nos ayuda a mejorar nuestros servicios. Lo invitamos a ingresar al sistema para que nos cuente como le fue.',
                            'tipo' => 'info',
                            'fecha' => $fechaCompuestaCita,
                            'cita_id' => $getCitas[$i]['id'],
                            'tipo_cita' => $getCitas[$i]['tipo']
                        ];
                        array_push($response, $array);
                        try {
                            $objData = new \stdClass();
                            $objData->sender = 'RapiMed';
                            $objData->paciente = $paciente->name;
                            $objData->email = $paciente->email;
                            $objData->especialistaDegree = $especialista->degree;
                            $objData->especialistaNombre = $especialista->name;
                            $objData->detalle = 'Su cita #' . $getCitas[$i]['id'] . ' se realizó ayer y notamos que aún no ha calificado su experiencia. Le recordamos que para nosotros su opinión es muy importante y nos ayuda a mejorar nuestros servicios. Lo invitamos a ingresar al sistema para que nos cuente como le fue.';
                            $objData->citaId = $getCitas[$i]['id'];
                            $objData->fecha = $fechaCita[0];
                            $objData->hora = $getCitas[$i]['hora_cita'];
                            $objData->tipo = 'Calificar';
                            Mail::to($paciente->email)->send(new RecordatorioCita($objData));
                            /* Mail::to($especialista->email)->send(new RecordatorioCita($objData)); */
                        } catch (Exception $e) {
                            logger($e);
                        }
                        if (count($ncc) >= 1) {
                            $saveDB = [
                                'ncc_mas_un_dia' => 1,
                                'updated_at' => $fechaActual
                            ];
                            DB::table('notifications_control_citas')->where('id', '=', $ncc[0]['id'])->update($saveDB);
                        } elseif (count($ncc) == 0) {
                            $saveDB = [
                                'ncc_cita_id' => $getCitas[$i]['id'],
                                'ncc_menos_diez' => 1,
                                'ncc_menos_cinco' => 1,
                                'ncc_inicio' => 1,
                                'ncc_mas_un_dia' => 1,
                                'created_at' => $fechaActual,
                                'updated_at' => $fechaActual
                            ];
                            DB::table('notifications_control_citas')->insert($saveDB);
                        }
                        logger(json_encode($response));
                    }
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

        return Command::SUCCESS;
    }
}
