@extends('layouts.app')
@section('content')
@include('layouts.dashboard.forms')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="form-head d-flex mb-sm-4 mb-3">
            <div class="mr-auto">
                <h2 class="text-black font-w600">Mis especialistas</h2>
                <p class="mb-0">Lista de especialistas asignados</p>
            </div>
            <div>
                <a href="javascript:void(0)" class="btn btn-primary mr-3" data-toggle="modal" data-target="#addOrderModal">+Nueva cita</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive card-table">
                    <table id="example5" class="display dataTablesCard table-responsive-xl">
                        <thead>
                            <tr>

                                <th></th>

                                <th>Nombre</th>
                                <th>Especialidad</th>
                                <th>Citas</th>
                                <th>Estatus</th>
                                <th>Calificación</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="{{ asset('assets/img/doctors/doctor_1.jpg') }}" alt="" width="43">
                                </td>
                                <td>Dra. Samantha</td>
                                <td>Dentist</td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-primary text-nowrap btn-sm light">5 Asignadas</a>
                                </td>
                                <td><span class="text-dark">Inactivo</span></td>
                                <td>
                                    <i class="fa-solid fa-heart" style="color: red"> 123</i>
                                    <i class="fa-solid fa-heart-crack" style="color: rgb(158, 0, 0)"> 0</i>
                                </td>
                                <td>
                                    <div class="dropdown ml-auto text-right">
                                        <div class="btn-link" data-toggle="dropdown">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Ver perfil</a>
                                            <a class="dropdown-item" href="#">Solicitar cita</a>
                                            <a class="dropdown-item" href="#">Bloquear</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="{{ asset('assets/img/doctors/doctor_3.jpg') }}" alt="" width="43">
                                </td>
                                <td>Dra. Cindy Anderson</td>
                                <td>Physical Therapy</td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-primary text-nowrap btn-sm light">2 Asignadas</a>
                                </td>
                                <td><span class="text-primary">Disponible</span></td>
                                <td>
                                    <i class="fa-solid fa-heart" style="color: red"> 57</i>
                                    <i class="fa-solid fa-heart-crack" style="color: rgb(158, 0, 0)"> 1</i>
                                </td>
                                <td>
                                    <div class="dropdown ml-auto text-right">
                                        <div class="btn-link" data-toggle="dropdown">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Ver perfil</a>
                                            <a class="dropdown-item" href="#">Solicitar cita</a>
                                            <a class="dropdown-item" href="#">Bloquear</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="{{ asset('assets/img/doctors/doctor_2.jpg') }}" alt="" width="43">
                                </td>
                                <td>Dr. Chi Yon</td>
                                <td>Dentist</td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-primary text-nowrap btn-sm light">1 Asignadas</a>
                                </td>
                                <td><span class="text-dark">Bloqueado</span></td>
                                <td>
                                    <i class="fa-solid fa-heart" style="color: red"> 5</i>
                                    <i class="fa-solid fa-heart-crack" style="color: rgb(158, 0, 0)"> 26</i>
                                </td>
                                <td>
                                    <div class="dropdown ml-auto text-right">
                                        <div class="btn-link" data-toggle="dropdown">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Ver perfil</a>
                                            <a class="dropdown-item" href="#">Desbloquear</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
