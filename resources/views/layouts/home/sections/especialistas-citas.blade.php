@php
setlocale(LC_ALL, 'Spanish_Venezuela');
for ($i=0; $i < count($datos); $i++) {
            echo '<div class="d-flex pb-3 border-bottom mb-3 align-items-end">
                <div class="mr-auto">';
            echo    '<p class="text-black font-w600 mb-2">'. utf8_encode(strftime("%A, %d de %B", strtotime($datos[$i]['cita_fecha']))) .'</p>
                    <ul>
                        <li><i class="las la-clock"></i>' . $datos[$i]['cita_hora'] . '</li>
                        <li><i class="las la-stethoscope"></i>' . $datos[$i]['specialist_degree'] . " " . $datos[$i]['specialist_name'] . '</li>
                        <li><i class="las la-user"></i>' . $datos[$i]['paciente_name'] . '</li>
                        <li><i class="las la-eye"></i>' . $datos[$i]['cita_tipo'] . '</li>';
                        switch ($datos[$i]['cita_status']) {
                            case 0:
                                echo '<li class="btn btn-warning text-nowrap btn-sm">Solicitada</li>';
                                break;
                            case 1:
                            case 7:
                                echo '<li class="btn btn-success text-nowrap btn-sm">Aceptada</li>';
                                break;
                            case 2:
                            case 3:
                                echo '<li class="btn btn-danger text-nowrap btn-sm light">Rechazada</li>';
                                break;
                            case 4:
                            case 5:
                            case 6:
                                echo '<li class="btn btn-danger text-nowrap btn-sm">Cancelada</li>';
                                break;
                            case 8:
                                echo '<li class="btn btn-info text-nowrap btn-sm">Concluida</li>';
                                break;
                        }
                echo    '</ul>
                </div>';
                    switch ($datos[$i]['cita_status']) {
                        case 0:
                            $aceptar = array('cita' => $datos[$i]['cita_id'], 'id' => $datos[$i]['cita_id'], 'status' => 1);
                            echo Form::open(['method' => 'PATCH','route' => ['citas.update', $aceptar], 'style'=>'display:inline']);
                            echo    Form::submit('Aceptar', ['class' => 'btn btn-primary']);
                            echo Form::close();
                            $rechazar = array('cita' => $datos[$i]['cita_id'], 'id' => $datos[$i]['cita_id'], 'status' => 2);
                            echo Form::open(['method' => 'PATCH','route' => ['citas.update', $rechazar], 'style'=>'display:inline']);
                            echo    Form::submit('Rechazar', ['class' => 'btn btn-danger']);
                            echo Form::close();
                            $cancelar = array('cita' => $datos[$i]['cita_id'], 'id' => $datos[$i]['cita_id'], 'status' => 4);
                            echo Form::open(['method' => 'PATCH','route' => ['citas.update', $cancelar], 'style'=>'display:inline']);
                            echo    Form::submit('Cancelar', ['class' => 'btn btn-danger light']);
                            echo Form::close();
                            /* echo    Form::submit('Reprogramar', ['class' => 'btn btn-info']); */
                            break;
                        case 1:
                        case 7:
                        
                            echo '<div class="modal fade" id="calificar'.$i.'">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Calificar</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">';
                            echo        Form::open(array('route' => 'score.store','method'=>'POST'));
                            echo        '<div class="form-group">
                                                <h3 class="text-black font-w500">¿Cómo le fue con el ' . $datos[$i]['specialist_degree'] . " " . $datos[$i]['specialist_name'] . '?</h3>
                                                <h5>En la cita del '. utf8_encode(strftime("%A, %d de %B", strtotime($datos[$i]['cita_fecha']))) .'</h5>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-black font-w500">¿Cuantos <i class="fa-solid fa-heart" style="color: red"></i> le das?</label>';
                                                $optionsTipo = [
                                                    '3' => '3',
                                                    '2' => '2',
                                                    '0' => '0',
                                                    '-1' => '-1',
                                                    '-2' => '-2',
                                                    '-3' => '-3'
                                                ];
                            echo        Form::select('score', $optionsTipo,[], array('placeholder' => 'Escoja su puntuación','class' => 'form-control','simple','fa'));
                            echo            '</div>
                                            <div class="form-group">';
                            echo        Form::textarea('commit', null, array('placeholder' => 'Escriba aquí una breve opinión sobre su experiencia','class' => 'form-control'));
                            echo            '</div>';
                            echo        Form::text('customer_id', $datos[$i]['paciente_id'], array('hidden'));
                            echo        Form::text('specialist_id', $datos[$i]['specialist_id'], array('hidden'));
                            echo        Form::text('cita_id', $datos[$i]['cita_id'], array('hidden'));
                            echo            '<small>Le notificaremos cuando le sea asignado un especialista y sea aceptada su solicitud.</small>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-heart"></i> Calificar</button>
                                            </div>';
                            echo        Form::close();
                            echo    '</div>
                                </div>
                            </div></div>';
                            echo '<a href="javascript:void(0)" class="btn btn-warning" data-toggle="modal" data-target="#calificar'.$i.'"><i class="fa-solid fa-heart"></i>Calificar</a>';
                            $cancelar = array('cita' => $datos[$i]['cita_id'], 'id' => $datos[$i]['cita_id'], 'status' => 4);
                            echo Form::open(['method' => 'PATCH','route' => ['citas.update', $cancelar], 'style'=>'display:inline']);
                            echo    Form::submit('Cancelar', ['class' => 'btn btn-danger light']);
                            echo Form::close();
                        
                            break;
                        case 4:
                        case 5:
                        case 6:
                            echo '<div class="modal fade" id="calificar'.$i.'">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Calificar</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">';
                            echo        Form::open(array('route' => 'score.store','method'=>'POST'));
                            echo        '<div class="form-group">
                                                <h3 class="text-black font-w500">¿Cómo le fue con el ' . $datos[$i]['specialist_degree'] . " " . $datos[$i]['specialist_name'] . '?</h3>
                                                <h5>En la cita del '. utf8_encode(strftime("%A, %d de %B", strtotime($datos[$i]['cita_fecha']))) .'</h5>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-black font-w500">¿Cuantos <i class="fa-solid fa-heart" style="color: red"></i> le das?</label>';
                                                $optionsTipo = [
                                                    '3' => '3',
                                                    '2' => '2',
                                                    '0' => '0',
                                                    '-1' => '-1',
                                                    '-2' => '-2',
                                                    '-3' => '-3'
                                                ];
                            echo        Form::select('score', $optionsTipo,[], array('placeholder' => 'Escoja su puntuación','class' => 'form-control','simple','fa'));
                            echo            '</div>
                                            <div class="form-group">';
                            echo        Form::textarea('commit', null, array('placeholder' => 'Escriba aquí una breve opinión sobre su experiencia','class' => 'form-control'));
                            echo            '</div>';
                            echo        Form::text('customer_id', $datos[$i]['paciente_id'], array('hidden'));
                            echo        Form::text('specialist_id', $datos[$i]['specialist_id'], array('hidden'));
                            echo        Form::text('cita_id', $datos[$i]['cita_id'], array('hidden'));
                            echo            '<small>Le notificaremos cuando le sea asignado un especialista y sea aceptada su solicitud.</small>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-heart"></i> Calificar</button>
                                            </div>';
                            echo        Form::close();
                            echo    '</div>
                                </div>
                            </div></div>';
                            echo '<a href="javascript:void(0)" class="btn btn-warning" data-toggle="modal" data-target="#calificar'.$i.'"><i class="fa-solid fa-heart"></i>Calificar</a>';
                            break;
                        case 8:
                            if ($datos[$i]['score'] == NULL) {
                            echo '<div class="modal fade" id="calificar'.$i.'">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Calificar</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">';
                            echo        Form::open(array('route' => 'score.store','method'=>'POST'));
                            echo        '<div class="form-group">
                                                <h3 class="text-black font-w500">¿Cómo le fue con el ' . $datos[$i]['specialist_degree'] . " " . $datos[$i]['specialist_name'] . '?</h3>
                                                <h5>En la cita del '. utf8_encode(strftime("%A, %d de %B", strtotime($datos[$i]['cita_fecha']))) .'</h5>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-black font-w500">¿Cuantos <i class="fa-solid fa-heart" style="color: red"></i> le das?</label>';
                                                $optionsTipo = [
                                                    '3' => '3',
                                                    '2' => '2',
                                                    '0' => '0',
                                                    '-1' => '-1',
                                                    '-2' => '-2',
                                                    '-3' => '-3'
                                                ];
                            echo        Form::select('score', $optionsTipo,[], array('placeholder' => 'Escoja su puntuación','class' => 'form-control','simple','fa'));
                            echo            '</div>
                                            <div class="form-group">';
                            echo        Form::textarea('commit', null, array('placeholder' => 'Escriba aquí una breve opinión sobre su experiencia','class' => 'form-control'));
                            echo            '</div>';
                            echo        Form::text('customer_id', $datos[$i]['paciente_id'], array('hidden'));
                            echo        Form::text('specialist_id', $datos[$i]['specialist_id'], array('hidden'));
                            echo        Form::text('cita_id', $datos[$i]['cita_id'], array('hidden'));
                            echo            '<small>Le notificaremos cuando le sea asignado un especialista y sea aceptada su solicitud.</small>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-heart"></i> Calificar</button>
                                            </div>';
                            echo        Form::close();
                            echo    '</div>
                                </div>
                            </div></div>';
                            echo '<a href="javascript:void(0)" class="btn btn-warning" data-toggle="modal" data-target="#calificar'.$i.'"><i class="fa-solid fa-heart"></i> Calificar</a>';
                            }
                            break;
                    }
                echo '
            </div>';
}
@endphp