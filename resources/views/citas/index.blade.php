@extends('layouts.app')
@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="form-head d-flex mb-sm-4 mb-3">
            <div class="mr-auto">
                <h2 class="text-black font-w600">Citas</h2>
                <p class="mb-0">Listado de citas</p>
            </div>
            <div>
                @can('customer-view')
                <a href="javascript:void(0)" class="btn btn-primary mr-3" data-toggle="modal" data-target="#addOrderModal">+Nueva cita</a>
                @endcan
                {{-- <a href="index.html" class="btn btn-outline-primary"><i class="las la-calendar-plus scale5 mr-3"></i>Filter Date</a> --}}
            </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        @include('layouts.dashboard.forms')
        <div class="row">
            <div class="col-12">
                <div class="table-responsive card-table"  style="min-height: 200px;">
                    <table id="example5" class="display dataTablesCard table-responsive-xl">
                @can('super-admin')
                    <thead>
                        <tr>
                            <th>Estatus</th>
                            <th>Fecha</th>
                            <th>Paciente</th>
                            <th>Especialista</th>
                            <th>Especialidad</th>
                            <th>Tipo</th>
                            <th>Acción</th>
                            <th>Calificación</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            for ($i=0; $i < count($datos); $i++) {
                                echo "<tr>";
                                    for ($j=0; $j < count($datos[$i]); $j++) {
                                        echo "<td>";
                                        switch ($datos[$i]['cita_status']) {
                                            case 0:
                                                echo '<span class="btn btn-warning text-nowrap btn-sm">Solicitada</span>';
                                                break;
                                            case 1:
                                            case 7:
                                                echo '<span class="btn btn-success text-nowrap btn-sm">Aceptada</span>';
                                                break;
                                            case 2:
                                            case 3:
                                                echo '<span class="btn btn-danger text-nowrap btn-sm light">Rechazada</span>';
                                                break;
                                            case 4:
                                            case 5:
                                            case 6:
                                                echo '<span class="btn btn-danger text-nowrap btn-sm">Cancelada</span>';
                                                break;
                                            case 8:
                                                echo '<span class="btn btn-info text-nowrap btn-sm">Concluida</span>';
                                                break;
                                        }
                                        echo "</td>";
                                        echo "<td>" . strftime("%d/%m/%Y, ", strtotime($datos[$i]['cita_fecha'])) . $datos[$i]['cita_hora'] . "</td>";
                                        echo "<td>" . $datos[$i]['specialist_name'] . "</td>";
                                        echo "<td>" . $datos[$i]['specialist_degree'] . " " . $datos[$i]['specialist_name'] . "</td>";
                                        echo "<td>" . $datos[$i]['specialist_specialty'] . "</td>";
                                        echo "<td>" . $datos[$i]['cita_tipo'] . "</td>";
                                        $citaid = $datos[$i]['cita_id'];
                                            echo "<td>";
                                            switch ($datos[$i]['cita_status']) {
                                                case 0:
                                                    echo    Form::submit('Reprogramar', ['class' => 'btn btn-info']);
                                                    $cancelar = array('cita' => $citaid, 'id' => $citaid, 'status' => 4);
                                                    echo Form::open(['method' => 'PATCH','route' => ['citas.update', $cancelar], 'style'=>'display:inline']);
                                                    echo    Form::submit('Cancelar', ['class' => 'btn btn-danger light']);
                                                    echo Form::close();
                                                    break;
                                                case 1:
                                                case 7:
                                                    echo    Form::submit('Reprogramar', ['class' => 'btn btn-info']);
                                                    $cancelar = array('cita' => $citaid, 'id' => $citaid, 'status' => 4);
                                                    echo Form::open(['method' => 'PATCH','route' => ['citas.update', $cancelar], 'style'=>'display:inline']);
                                                    echo    Form::submit('Cancelar', ['class' => 'btn btn-danger light']);
                                                    echo Form::close();
                                                    break;
                                                case 2:
                                                case 3:
                                                    echo    Form::submit('Reprogramar', ['class' => 'btn btn-info']);
                                                    break;
                                            }
                                            echo '</td>';
                                            echo '<td>
                                                <i class="fa-solid fa-heart'. ($datos[$i]['score'] < (0) ? "-crack" : "") .'" style="color:'. ($datos[$i]['score'] < (0) ? "black" : "red") .'">' . (isset($datos[$i]['score']) ? $datos[$i]['score'] : " Sin calificar") . '</i>
                                            </td>';
                                    }
                                echo "</tr>";
                            }
                        @endphp
                    </tbody>
                @elsecan('customer-view')
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Estatus</th>
                                <th>Fecha</th>
                                <th>Especialista</th>
                                <th>Especialidad</th>
                                <th>Tipo</th>
                                <th>Acción</th>
                                <th>Calificación</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            setlocale(LC_ALL, 'Spanish_Venezuela');
                            $user_id = Auth::user()->id;
                                for ($i=0; $i < count($datos); $i++) {
                                    echo "<tr>";
                                        echo "<td>" . $datos[$i]['cita_id'] . "</td>";
                                        echo "<td>";
                                        switch ($datos[$i]['cita_status']) {
                                            case 0:
                                                echo '<span class="btn btn-warning text-nowrap btn-sm">Solicitada</span>';
                                                break;
                                            case 1:
                                            case 7:
                                                echo '<span class="btn btn-success text-nowrap btn-sm">Aceptada</span>';
                                                break;
                                            case 2:
                                            case 3:
                                                echo '<span class="btn btn-danger text-nowrap btn-sm light">Rechazada</span>';
                                                break;
                                            case 4:
                                            case 5:
                                            case 6:
                                                echo '<span class="btn btn-danger text-nowrap btn-sm">Cancelada</span>';
                                                break;
                                            case 8:
                                                echo '<span class="btn btn-info text-nowrap btn-sm">Concluida</span>';
                                                break;
                                        }
                                        echo "</td>";
                                        echo "<td>" . strftime("%d/%m/%Y, ", strtotime($datos[$i]['cita_fecha'])) . $datos[$i]['cita_hora'] . "</td>";
                                        echo "<td><a href='" .  route('users.show', $datos[$i]['specialist_user_id'])  . "'>" . $datos[$i]['specialist_degree'] . " " . $datos[$i]['specialist_name'] . "</a></td>";
                                        echo "<td>" . $datos[$i]['specialist_specialty'] . "</td>";
                                        echo "<td>" . $datos[$i]['cita_tipo'] . "</td>";
                                        $citaid = $datos[$i]['cita_id'];
                                        echo "<td>";
                                        switch ($datos[$i]['cita_status']) {
                                            case 0:
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
                                                                    <h3 class="text-black font-w500">¿Cómo le fue con el ' . $datos[$i]['specialist_degree'] . " " . $datos[$i]['specialist_name'] . '</h3>
                                                                    <h5>en la cita del '. utf8_encode(strftime("%A %d de %B", strtotime($datos[$i]['cita_fecha']))) .'?</h5>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="text-black font-w500">¿Cuantos <i class="fa-solid fa-heart" style="color: red"></i> le da?</label>';
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
                                                echo        Form::text('customer_id', $user_id, array('hidden'));
                                                echo        Form::text('specialist_id', $datos[$i]['specialist_id'], array('hidden'));
                                                echo        Form::text('cita_id', $citaid, array('hidden'));
                                                echo            '<small style="padding: 2%;">Para nosotros su opinion es muy importante.</small>
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Calificar</button>
                                                                </div>';
                                                echo        Form::close();
                                                echo    '</div>
                                                    </div>
                                                </div></div>';
                                                echo '<a href="javascript:void(0)" class="btn btn-warning" data-toggle="modal" data-target="#calificar'.$i.'">Calificar</a>';
                                                $cancelar = array('cita' => $citaid, 'id' => $citaid, 'status' => 4);
                                                echo Form::open(['method' => 'PATCH','route' => ['citas.update', $cancelar], 'style'=>'display:inline']);
                                                echo    Form::submit('Cancelar', ['class' => 'btn btn-danger light']);
                                                echo Form::close();
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
                                                                    <h3 class="text-black font-w500">¿Cómo le fue con el ' . $datos[$i]['specialist_degree'] . " " . $datos[$i]['specialist_name'] . '</h3>
                                                                    <h5>en la cita del '. utf8_encode(strftime("%A %d de %B", strtotime($datos[$i]['cita_fecha']))) .'?</h5>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="text-black font-w500">¿Cuantos <i class="fa-solid fa-heart" style="color: red"></i> le da?</label>';
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
                                                echo        Form::text('customer_id', $user_id, array('hidden'));
                                                echo        Form::text('specialist_id', $datos[$i]['specialist_id'], array('hidden'));
                                                echo        Form::text('cita_id', $citaid, array('hidden'));
                                                echo            '<small style="padding: 2%;">Para nosotros su opinion es muy importante.</small>
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Calificar</button>
                                                                </div>';
                                                echo        Form::close();
                                                echo    '</div>
                                                    </div>
                                                </div></div>';
                                                echo '<a href="javascript:void(0)" class="btn btn-warning" data-toggle="modal" data-target="#calificar'.$i.'">Calificar</a>';
                                                $cancelar = array('cita' => $citaid, 'id' => $citaid, 'status' => 4);
                                                echo Form::open(['method' => 'PATCH','route' => ['citas.update', $cancelar], 'style'=>'display:inline']);
                                                echo    Form::submit('Cancelar', ['class' => 'btn btn-danger light']);
                                                echo Form::close();
                                                break;
                                            case 3:
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
                                                                    <h3 class="text-black font-w500">¿Cómo le fue con el ' . $datos[$i]['specialist_degree'] . " " . $datos[$i]['specialist_name'] . '</h3>
                                                                    <h5>en la cita del '. utf8_encode(strftime("%A %d de %B", strtotime($datos[$i]['cita_fecha']))) .'?</h5>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="text-black font-w500">¿Cuantos <i class="fa-solid fa-heart" style="color: red"></i> le da?</label>';
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
                                                echo        Form::text('customer_id', $user_id, array('hidden'));
                                                echo        Form::text('specialist_id', $datos[$i]['specialist_id'], array('hidden'));
                                                echo        Form::text('cita_id', $citaid, array('hidden'));
                                                echo            '<small style="padding: 2%;">Para nosotros su opinion es muy importante.</small>
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Calificar</button>
                                                                </div>';
                                                echo        Form::close();
                                                echo    '</div>
                                                    </div>
                                                </div></div>';
                                                echo '<a href="javascript:void(0)" class="btn btn-warning" data-toggle="modal" data-target="#calificar'.$i.'">Calificar</a>';
                                                break;
                                            case 4:
                                            case 5:
                                            case 6:
                                            if ($datos[$i]['score'] == 'NULL') {
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
                                                                    <h3 class="text-black font-w500">¿Cómo le fue con el ' . $datos[$i]['specialist_degree'] . " " . $datos[$i]['specialist_name'] . '</h3>
                                                                    <h5>en la cita del '. utf8_encode(strftime("%A %d de %B", strtotime($datos[$i]['cita_fecha']))) .'?</h5>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="text-black font-w500">¿Cuantos <i class="fa-solid fa-heart" style="color: red"></i> le da?</label>';
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
                                                echo        Form::text('customer_id', $user_id, array('hidden'));
                                                echo        Form::text('specialist_id', $datos[$i]['specialist_id'], array('hidden'));
                                                echo        Form::text('cita_id', $citaid, array('hidden'));
                                                echo            '<small style="padding: 2%;">Para nosotros su opinion es muy importante.</small>
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Calificar</button>
                                                                </div>';
                                                echo        Form::close();
                                                echo    '</div>
                                                    </div>
                                                </div></div>';
                                                echo '<a href="javascript:void(0)" class="btn btn-warning" data-toggle="modal" data-target="#calificar'.$i.'">Calificar</a>';
                                                break;
                                            }
                                            echo "</td>";
                                        }
                                        echo    '<td>
                                                    <i class="fa-solid fa-heart'. ($datos[$i]['score'] < (0) ? "-crack" : "") .'" style="color:'. ($datos[$i]['score'] < (0) ? "black" : "red") .'">' . ($datos[$i]['score'] == "NULL" ? " X" : $datos[$i]['score']) . '</i>
                                                </td>
                                            </tr>';
                                }
                            @endphp
                        </tbody>
                @elsecan('specialist-view')
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Estatus</th>
                            <th>Fecha</th>
                            <th>Paciente</th>
                            <th>Tipo</th>
                            <th>Acción</th>
                            <th>Calificación</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        setlocale(LC_ALL, 'Spanish_Venezuela');
                        $user_id = Auth::user()->id;
                            for ($i=0; $i < count($datos); $i++) {
                                echo "<tr>";
                                echo "<td>" . $datos[$i]['cita_id'] . "</td>";
                                echo    "<td>";
                                switch ($datos[$i]['cita_status']) {
                                    case 0:
                                        echo '<span class="btn btn-warning text-nowrap btn-sm">Solicitada</span>';
                                        break;
                                    case 1:
                                    case 7:
                                        echo '<span class="btn btn-success text-nowrap btn-sm">Aceptada</span>';
                                        break;
                                    case 2:
                                    case 3:
                                        echo '<span class="btn btn-danger text-nowrap btn-sm light">Rechazada</span>';
                                        break;
                                    case 4:
                                    case 5:
                                    case 6:
                                        echo '<span class="btn btn-danger text-nowrap btn-sm">Cancelada</span>';
                                        break;
                                    case 8:
                                        echo '<span class="btn btn-info text-nowrap btn-sm">Concluida</span>';
                                        break;
                                }
                                echo "</td>";
                                echo "<td>" . strftime("%d/%m/%Y, ", strtotime($datos[$i]['cita_fecha'])) . $datos[$i]['cita_hora'] . "</td>";
                                echo "<td><a href='" .  route('users.show', $datos[$i]['paciente_id'])  . "'>" . $datos[$i]['paciente_name'] . "</a></td>";
                                echo "<td>" . $datos[$i]['cita_tipo'] . "</td>";
                                echo "<td>";
                                $citaid = $datos[$i]['cita_id'];
                                switch ($datos[$i]['cita_status']) {
                                    case 0:
                                        $aceptar = array('cita' => $citaid, 'id' => $citaid, 'status' => 1);
                                        echo Form::open(['method' => 'PATCH','route' => ['citas.update', $aceptar], 'style'=>'display:inline']);
                                        echo    Form::submit('Aceptar', ['class' => 'btn btn-primary']);
                                        echo Form::close();
                                        $rechazar = array('cita' => $citaid, 'id' => $citaid, 'status' => 2);
                                        echo Form::open(['method' => 'PATCH','route' => ['citas.update', $rechazar], 'style'=>'display:inline']);
                                        echo    Form::submit('Rechazar', ['class' => 'btn btn-danger']);
                                        echo Form::close();
                                        $cancelar = array('cita' => $citaid, 'id' => $citaid, 'status' => 4);
                                        echo Form::open(['method' => 'PATCH','route' => ['citas.update', $cancelar], 'style'=>'display:inline']);
                                        echo    Form::submit('Cancelar', ['class' => 'btn btn-danger light']);
                                        echo Form::close();
                                        break;
                                    case 1:
                                    case 7:
                                        echo    Form::submit('Calificar', ['class' => 'btn btn-warning']);
                                        $cancelar = array('cita' => $citaid, 'id' => $citaid, 'status' => 4);
                                        echo Form::open(['method' => 'PATCH','route' => ['citas.update', $cancelar], 'style'=>'display:inline']);
                                        echo    Form::submit('Cancelar', ['class' => 'btn btn-danger light']);
                                        echo Form::close();
                                        break;
                                    case 4:
                                    case 5:
                                    case 6:
                                        if ($datos[$i]['score_customers'] == 'NULL') {
                                            echo '<div class="modal fade" id="calificar'.$i.'">
                                                <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Calificar</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">';
                                            echo        Form::open(array('route' => 'scorecustomer.store','method'=>'POST'));
                                            echo        '<div class="form-group">
                                                                <h3 class="text-black font-w500"><span style="color: #555">¿Cómo le fue con el/la paciente</span> ' . $datos[$i]['paciente_name'] . '</h3>
                                                                <h5>en la cita del '. utf8_encode(strftime("%A %d de %B", strtotime($datos[$i]['cita_fecha']))) .'?</h5>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="text-black font-w500">¿Cuantos <i class="fa-solid fa-heart" style="color: red"></i> le da?</label>';
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
                                            echo        Form::text('customer_id', $user_id, array('hidden'));
                                            echo        Form::text('specialist_id', $datos[$i]['specialist_id'], array('hidden'));
                                            echo        Form::text('cita_id', $citaid, array('hidden'));
                                            echo            '<small style="padding: 2%;">Para nosotros su opinion es muy importante.</small>
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-primary" style="margin-top: 10px;"><i class="fa-solid fa-heart"></i> Calificar</button>
                                                            </div>';
                                            echo        Form::close();
                                            echo    '</div>
                                                </div>
                                            </div></div>';
                                            echo '<a href="javascript:void(0)" class="btn btn-warning" data-toggle="modal" data-target="#calificar'.$i.'">Calificar</a>';
                                        }
                                        break;
                                    case 8:
                                        if ($datos[$i]['score_customers'] == 'NULL') {
                                                echo '<div class="modal fade" id="calificar'.$i.'">
                                                    <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Calificar</h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">';
                                                echo        Form::open(array('route' => 'scorecustomer.store','method'=>'POST'));
                                                echo        '<div class="form-group">
                                                                    <h3 class="text-black font-w500">¿Cómo le fue con el ' . $datos[$i]['specialist_degree'] . " " . $datos[$i]['specialist_name'] . '</h3>
                                                                    <h5>en la cita del '. utf8_encode(strftime("%A %d de %B", strtotime($datos[$i]['cita_fecha']))) .'?</h5>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="text-black font-w500">¿Cuantos <i class="fa-solid fa-heart" style="color: red"></i> le da?</label>';
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
                                                echo        Form::text('customer_id', $user_id, array('hidden'));
                                                echo        Form::text('specialist_id', $datos[$i]['specialist_id'], array('hidden'));
                                                echo        Form::text('cita_id', $citaid, array('hidden'));
                                                echo            '<small style="padding: 2%;">Para nosotros su opinion es muy importante.</small>
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-primary" style="margin-top: 10px;"><i class="fa-solid fa-heart"></i> Calificar</button>
                                                                </div>';
                                                echo        Form::close();
                                                echo    '</div>
                                                    </div>
                                                </div></div>';
                                                echo '<a href="javascript:void(0)" class="btn btn-warning" data-toggle="modal" data-target="#calificar'.$i.'"><i class="fa-solid fa-heart" style="color: red"></i> Calificar</a>';
                                                break;
                                            }
                                        break;
                                }
                                echo "</td>";
                                echo    '<td>
                                    <i class="fa-solid fa-heart'. ($datos[$i]['score_customers'] < (0) ? "-crack" : "") .'" style="color:'. ($datos[$i]['score_customers'] < (0) ? "black" : "red") .'">' . ($datos[$i]['score_customers'] == "NULL" ? " X" : $datos[$i]['score_customers']) . '</i>
                                    </td>
                                </tr>';
                            }
                        @endphp
                    </tbody>
                    @endcan
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
