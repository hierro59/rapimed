@extends('layouts.app')
@section('content')
@include('layouts.dashboard.forms')
<div class="content-body">
    <div class="container-fluid">
        <div class="form-head d-flex align-items-center mb-sm-4 mb-3">
            <div class="mr-auto">
                <h2 class="text-black font-w600">RapiMed</h2>
                <p class="mb-0">Dashboard</p>
            </div>
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
        @if ($completedMetadata)
            <div class="alert alert-warning solid alert-right-icon alert-dismissible fade show">
                <span><i class="mdi mdi-alert"></i></span>
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                </button>
                <strong>¡Alerta!</strong> Hemos notado que aún no completa sus datos. Para tener una mejor experiencia con nuestros servicios, le recomendamos <a href="{{ route('users.show', Auth::user()->id) }}" style="color: #fff">completar su perfil.</a>
            </div>
        @endif
        @if ($getCitasInfo)
            <div class="alert alert-{{ $getCitasInfo[0]['tipo'] }} solid alert-right-icon alert-dismissible fade show">
                <span><i class="mdi mdi-alert"></i></span>
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                </button>
                <strong>{{ $getCitasInfo[0]['titulo'] }}</strong> 
                <p>{{ $getCitasInfo[0]['detalle'] }}</p>
                @if (isset($getCitasInfo[0]['tipo_cita']) == 'Virtual')
                    <a href="{{ route('consultorio-virtual', $getCitasInfo[0]['cita_id']) }}" class="btn btn-primary">Ingresar a consulta virtual</a>
                @endif
            </div>
        @endif
        <!--**********************************
            Seccion Botones start
        ***********************************-->
        <div class="row">
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <a href="{{ route('citas.index') }}" style="text-decoration: none; display: flex; color: #111;">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body mr-3">
                                <h2 class="fs-34 text-black font-w600">Citas</h2>
                                <span>Mis citas</span>
                            </div>
                            <i class="flaticon-381-notepad" style="font-size: 2rem; color: #555"></i>
                        </div>
                    </div>
                    </a>
                </div>
            </div>

            @can('customer-view')
                @include('layouts.home.sections.pacientes-buttons')
            @endcan

            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <a href="{{ route('users.show', Auth::user()->id) }}" style="text-decoration: none; display: flex; color: #111;">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body mr-3">
                                <h2 class="fs-34 text-black font-w600">Perfil</h2>
                                <span>Mi perfil</span>
                            </div>
                            <i class="flaticon-381-user-7" style="font-size: 2rem; color: #555"></i>
                        </div>
                    </div>
                    </a>
                </div>
            </div>

            @can('super-admin')
                @include('layouts.home.sections.superadmin-buttons')
            @endcan
        </div>
        <!--**********************************
            Seccion Botones end
        ***********************************-->
        
        <div class="row">
        <!--**********************************
            Seccion Citas start
        ***********************************-->                
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card appointment-schedule">
                            <div class="card-header pb-0 border-0">
                                <h3 class="fs-20 text-black mb-0">Solicitud de Citas</h3>
                                <div class="dropdown ml-auto">
                                    <div class="btn-link p-2 bg-light" data-toggle="dropdown">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        {{-- <a class="dropdown-item text-black" href="javascript:;">Info</a> --}}
                                        <a class="dropdown-item text-black" href="{{ route('citas.index') }}">Ver todas</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-6 col-xxl-12 col-md-6">
                                        <div class="appointment-calender">
                                            <input type='text' class="form-control d-none" id='datetimepicker1' />
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-xxl-12  col-md-6 height415 dz-scroll" id="appointment-schedule">
                                        @can('super-admin')
                                            @include('layouts.home.sections.superadmin-citas')
                                        @elsecan('specialist-view')
                                            @include('layouts.home.sections.especialistas-citas')
                                        @elsecan('customer-view')
                                            @include('layouts.home.sections.pacientes-citas')
                                        @elsecan('coordcitas-view')
                                            @include('layouts.home.sections.coordcitas-citas')
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        <!--**********************************
            Seccion Citas end
        ***********************************-->
        <!--**********************************
            Calificaciones start
        ***********************************-->
                    <div class="col-xl-12">
                        <div class="card patient-activity">
                            <div class="card-header border-0 pb-0">
                                <h3 class="fs-20 text-black mb-0"><i class="fa-solid fa-heart" style="color: red"></i> Calificaciones</h3>
                                <div class="dropdown ml-auto">
                                    <div class="btn-link" data-toggle="dropdown">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.0001 12C13.0001 11.4477 12.5523 11 12.0001 11C11.4478 11 11.0001 11.4477 11.0001 12C11.0001 12.5523 11.4478 13 12.0001 13C12.5523 13 13.0001 12.5523 13.0001 12Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M6.00006 12C6.00006 11.4477 5.55235 11 5.00006 11C4.44778 11 4.00006 11.4477 4.00006 12C4.00006 12.5523 4.44778 13 5.00006 13C5.55235 13 6.00006 12.5523 6.00006 12Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M20.0001 12C20.0001 11.4477 19.5523 11 19.0001 11C18.4478 11 18.0001 11.4477 18.0001 12C18.0001 12.5523 18.4478 13 19.0001 13C19.5523 13 20.0001 12.5523 20.0001 12Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </div>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item text-black" href="javascript:;">Ver todas</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pb-0" >
                                <div class="table-responsive height720 dz-scroll" id="patient-activity">
                                    <table class="table table-responsive-sm">
                                        <tbody>
                                        @can('super-admin')
                                            @include('layouts.home.sections.superadmin-calificaciones')
                                        @elsecan('specialist-view')
                                            @include('layouts.home.sections.especialistas-calificaciones')
                                        @elsecan('customer-view')
                                            @include('layouts.home.sections.pacientes-calificaciones')
                                        @elsecan('coordcitas-view')
                                            @include('layouts.home.sections.superadmin-calificaciones')
                                        @endcan
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-center border-0">
                                <a href="#" class="btn-link">Ver más >></a>
                            </div>
                        </div>
                    </div>
        <!--**********************************
            Calificaciones end
        ***********************************-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
