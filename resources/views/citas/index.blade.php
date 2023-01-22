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
                <a href="javascript:void(0)" class="btn btn-primary mr-3" data-toggle="modal" data-target="#addOrderModal">+Nueva cita</a>
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
                    @can('appointment-show-own')
                        <thead>
                            <tr>
                                <th>Estatus</th>
                                <th>Fecha</th>
                                <th>Paciente</th>
                                <th>Especialista</th>
                                <th>Especialidad</th>
                                <th>Tipo</th>
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
                                            echo "<td>Paciente</td>";
                                            echo "<td>" . $array[$i][$j]->degree . " " . $array[$i][$j]->name . "</td>";
                                            echo "<td>" . $array[$i][$j]->specialty . "</td>";
                                            echo "<td>" . $citas[$i]->tipo . "</td>";
                                            echo    '<td>
                                                    <i class="fa-solid fa-heart'. ($citas[$i]->score < (0) ? "-crack" : "") .'" style="color:'. ($citas[$i]->score < (0) ? "black" : "red") .'">' . (isset($citas[$i]->score) ? $citas[$i]->score : " Sin calificar") . '</i>
                                                </td>';
                                            echo    '<td>
                                                    <div class="dropdown ml-auto text-right">
                                                        <div class="btn-link" data-toggle="dropdown">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#">View Detail</a>
                                                            <a class="dropdown-item" href="#">Edit</a>
                                                            <a class="dropdown-item" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>';
                                        }
                                    echo "</tr>";
                                }
                            @endphp
                        </tbody>
                    @else
                        <thead>
                            <tr>
                                <th>Estatus</th>
                                <th>Fecha</th>
                                <th>Especialista</th>
                                <th>Especialidad</th>
                                <th>Tipo</th>
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
                                            echo    '<td>
                                                    <i class="fa-solid fa-heart'. ($citas[$i]->score < (0) ? "-crack" : "") .'" style="color:'. ($citas[$i]->score < (0) ? "black" : "red") .'">' . (isset($citas[$i]->score) ? $citas[$i]->score : " Sin calificar") . '</i>
                                                </td>';
                                            echo    '<td>
                                                    <div class="dropdown ml-auto text-right">
                                                        <div class="btn-link" data-toggle="dropdown">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#">View Detail</a>
                                                            <a class="dropdown-item" href="#">Edit</a>
                                                            <a class="dropdown-item" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>';
                                        }
                                    echo "</tr>";
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
