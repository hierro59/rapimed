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
                            for ($i=0; $i < count($array); $i++) {
                                echo "<tr>";
                                    for ($j=0; $j < count($array[$i]); $j++) {
                                        echo "<td>";
                                        switch ($citas[$i]->status) {
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
                                                echo '<span class="btn btn-info text-nowrap btn-sm">Realizada</span>';
                                                break;
                                        }
                                        echo "</td>";
                                        echo "<td>" . strftime("%d/%m/%Y, ", strtotime($citas[$i]->fecha_cita)) . $citas[$i]->hora_cita . "</td>";
                                        echo "<td>" . $array[$i][$j]->name . "</td>";
                                        echo "<td>" . $array[$i][$j]->degree . " " . $array[$i][$j]->name . "</td>";
                                        echo "<td>" . $array[$i][$j]->specialty . "</td>";
                                        echo "<td>" . $citas[$i]->tipo . "</td>";
                                        $citaid = $citas[$i]->id;
                                            echo "<td>";
                                            switch ($citas[$i]->status) {
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
                                                <i class="fa-solid fa-heart'. ($citas[$i]->score < (0) ? "-crack" : "") .'" style="color:'. ($citas[$i]->score < (0) ? "black" : "red") .'">' . (isset($citas[$i]->score) ? $citas[$i]->score : " Sin calificar") . '</i>
                                            </td>';
                                    }
                                echo "</tr>";
                            }
                        @endphp
                    </tbody>
                    @elsecan('customer-view')
                        <thead>
                            <tr>
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
                                for ($i=0; $i < count($array); $i++) {
                                    echo "<tr>";
                                        for ($j=0; $j < count($array[$i]); $j++) {
                                            echo "<td>";
                                            switch ($citas[$i]->status) {
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
                                                    echo '<span class="btn btn-info text-nowrap btn-sm">Realizada</span>';
                                                    break;
                                            }
                                            echo "</td>";
                                            echo "<td>" . strftime("%d/%m/%Y, ", strtotime($citas[$i]->fecha_cita)) . $citas[$i]->hora_cita . "</td>";
                                            echo "<td>" . $array[$i][$j]->degree . " " . $array[$i][$j]->name . "</td>";
                                            echo "<td>" . $array[$i][$j]->specialty . "</td>";
                                            echo "<td>" . $citas[$i]->tipo . "</td>";
                                            $citaid = $citas[$i]->id;
                                            echo "<td>";
                                            switch ($citas[$i]->status) {
                                                case 0:
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
                                                case 2:
                                                case 3:
                                                    echo    Form::submit('Calificar', ['class' => 'btn btn-warning']);
                                                    break;
                                                case 4:
                                                case 5:
                                                case 6:
                                                    echo    Form::submit('Calificar', ['class' => 'btn btn-warning light']);
                                                    break;
                                                case 8:
                                                    echo    Form::submit('Calificar', ['class' => 'btn btn-warning']);
                                                    break;
                                            }
                                            echo "</td>";
                                                echo    '<td>
                                                        <i class="fa-solid fa-heart'. ($citas[$i]->score < (0) ? "-crack" : "") .'" style="color:'. ($citas[$i]->score < (0) ? "black" : "red") .'">' . (isset($citas[$i]->score) ? $citas[$i]->score : " Sin calificar") . '</i>
                                                    </td>';
                                            }
                                    echo "</tr>";
                                }
                            @endphp
                        </tbody>
                    @elsecan('specialist-view')
                    <thead>
                        <tr>
                            <th>Estatus</th>
                            <th>Fecha</th>
                            <th>Paciente</th>
                            {{-- <th>Especialidad</th> --}}
                            <th>Tipo</th>
                            <th>Acción</th>
                            <th>Calificación</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @php
                            for ($i=0; $i < count($array); $i++) {
                                    for ($j=0; $j < count($array[$i]); $j++) {
                                        echo "<tr><td>";
                                        switch ($citas[$i]->status) {
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
                                                echo '<span class="btn btn-info text-nowrap btn-sm">Realizada</span>';
                                                break;
                                        }
                                        echo "</td>";
                                        echo "<td>" . strftime("%d/%m/%Y, ", strtotime($citas[$i]->fecha_cita)) . $citas[$i]->hora_cita . "</td>";
                                        echo "<td>" . $array[$i][$j]->name . "</td>";
                                        //echo "<td>" . $array[$i][$j]->specialty . "</td>";
                                        echo "<td>" . $citas[$i]->tipo . "</td>";
                                        echo "<td>";
                                        $citaid = $citas[$i]->id;
                                        switch ($citas[$i]->status) {
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
                                            case 2:
                                            case 3:
                                                echo    Form::submit('Reprogramar', ['class' => 'btn btn-info']);
                                                break;
                                            case 4:
                                            case 5:
                                            case 6:
                                                echo    Form::submit('Calificar', ['class' => 'btn btn-warning light']);
                                                break;
                                            case 8:
                                                echo    Form::submit('Calificar', ['class' => 'btn btn-warning']);
                                                break;
                                        }
                                        echo "</td>";
                                        echo    '<td>
                                                <i class="fa-solid fa-heart'. ($citas[$i]->score < (0) ? "-crack" : "") .'" style="color:'. ($citas[$i]->score < (0) ? "black" : "red") .'">' . (isset($citas[$i]->score) ? $citas[$i]->score : " Sin calificar") . '</i>
                                            </td>
                                        </tr>';
                                    }
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
