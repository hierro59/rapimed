@php
setlocale(LC_ALL, 'Spanish_Venezuela');
for ($i=0; $i < count($datos); $i++) {
            echo '<div class="d-flex pb-3 border-bottom mb-3 align-items-end">
                <div class="mr-auto">
                    <p class="text-black font-w600 mb-2">'. utf8_encode(strftime("%A, %d de %B", strtotime($datos[$i]['cita_fecha']))) .'</p>
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
                        echo    '<a href="' . route("citas.edit", $datos[$i]['cita_id']) . '" class="btn btn-info">Reprogramar</a>';
                        $cancelar = array('cita' => $datos[$i]['cita_id'], 'id' => $datos[$i]['cita_id'], 'status' => 4);
                        echo Form::open(['method' => 'PATCH','route' => ['citas.update', $cancelar], 'style'=>'display:inline']);
                        echo    Form::submit('Cancelar', ['class' => 'btn btn-danger light']);
                        echo Form::close();
                        break;
                    case 1:
                    case 7:
                        echo    Form::submit('Reprogramar', ['class' => 'btn btn-info']);
                        $cancelar = array('cita' => $datos[$i]['cita_id'], 'id' => $datos[$i]['cita_id'], 'status' => 4);
                        echo Form::open(['method' => 'PATCH','route' => ['citas.update', $cancelar], 'style'=>'display:inline']);
                        echo    Form::submit('Cancelar', ['class' => 'btn btn-danger light']);
                        echo Form::close();
                        break;
                    case 2:
                    case 3:
                        echo    Form::submit('Reprogramar', ['class' => 'btn btn-info']);
                        break;
                }

                echo '
            </div>';
}
@endphp