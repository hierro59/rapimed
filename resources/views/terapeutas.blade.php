@extends('layouts.page')
@section('content')
<div class="container px-4">
    <div class="row gx-2">
        <div class="profile-skills mb-5">
            <h4 class="text-primary mb-2">Tipo de consulta</h4>
            <a href="javascript:void()" class="btn btn-primary light btn-xs mb-1"><i class="fa-solid fa-house-medical-circle-check"></i> Domicilio</a>
            <a href="javascript:void()" class="btn btn-primary light btn-xs mb-1"><i class="fa-solid fa-headset"></i> Virtual</a>
            <a href="javascript:void()" class="btn btn-primary light btn-xs mb-1"><i class="fa-solid fa-hospital"></i> Consultorio</a>
        </div>
    </div>
</div>
<div class="container px-4">
    <div class="row gx-2">
        @for ($i = 0; $i < count($data); $i++)
            <div class="col-sm-3">
                <div class="item">
                    <div class="card-doctor">
                    <div class="header">
                        <img src="/thumbnail/profile/{{ $data[$i]['avatar'] }}" alt="">
                        <div class="meta">
                        <a href="{{ route('perfil', $data[$i]['user_id']) }}" title="Agenda una cita"><i class="fa-regular fa-calendar-check"></i></a>
                        <a href="{{ route('perfil', $data[$i]['user_id']) }}" title="Ver perfil"><i class="fa-regular fa-eye"></i></a>
                        </div>
                    </div>
                    <div class="body">
                        <p class="text-xl mb-0">{{ $data[$i]['degree'] }}. {{ $data[$i]['nombre'] }}</p>
                        <span class="text-sm text-grey">{{ $data[$i]['especialidad'] }}</span>
                    </div>
                    </div>
                </div>
            </div>
        @endfor
        {{-- <div class="col-3">
            <a href="{{ route('doctors') }}" class="pull-right f-s-8">
            <div class="item">
                <div class="card-doctor">
                <div class="header">
                    <img src="/thumbnail/profile/generic-user.png" alt="">
                    
                </div>
                <div class="body">
                    <p class="text-xl mb-0">Ver todos..</p>
                    <br>
                </div>
                </div>
            </div>
        </a>
        </div> --}}
    </div>
</div>

<!-- Formulario Nueva Cita -->
<a id="nuevacita"></a>
<div class="page-section pb-0 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 py-3 wow fadeInUp">
                <h1>Bienvenido a tu<br>Asistente de Salud</h1>
                <p class="text-grey mb-4"><b>RapiMed</b> conecta los mundos físico y digital con solo tocar un botón. Porque creemos en un mundo accesible. Para que puedas moverte y ganar con seguridad, de una manera que sea sostenible para nuestro planeta. Sin importar género, raza, religión, habilidades u orientación sexual; defendemos su derecho a moverse libremente, sin miedo.</p>
                <p class="text-grey mb-4">Afiliantote a <b>RapiMed</b>, tendrás total acceso (Full Access) a nuestros servicios. Asignación de consultas médicas especializadas presenciales, a domicilio u online; asignadas por geolocalización.</p>
                @auth
                <a href="{{ route('home') }}" class="btn btn-primary">Ir al Dashboard</a>
                @else
                <a href="{{ route('register') }}" class="btn btn-primary">Regístrate</a>
                @endauth
            </div>
            <div class="col-lg-6 wow fadeInRight" data-wow-delay="400ms">
                <div class="img-place custom-img-1">
                    <img src="{{ asset('assets/img/bg-doctor.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</div> <!-- .bg-light -->
@endsection