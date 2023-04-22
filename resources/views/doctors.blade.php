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
                        <a href="#nuevacita" title="Agenda una cita"><i class="fa-regular fa-calendar-check"></i></a>
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
  <div class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h1 class="text-center wow fadeInUp">Agendar una cita</h1>
                <p>A través de este formulario podrá solicitar una cita con uno de nuestros especialistas. La fecha que coloque, será referencial y estará sujeta de verificación de disponibilidad por parte de nuestros especialistas. Tenga cuidado con los datos que nos suministra ya que por ese medio le notificaremos cuando su cita sea aprobada.</p>
                <p>En RapiMed somos muy cuidadosos con la información que usted nos entregue; la encriptaremos y solo compartiremos lo datos esenciales con el especialista que se le asigne, para que pueda comunicarse con usted. Su privacidad es un factor MUY IMPORTANTE para nosotros.</p>
            </div>
            <div class="col-sm-8">
                {!! Form::open(array('route' => 'send','method'=>'POST')) !!}
                @csrf
                {{-- <form class="main-form" action="{{ route('send') }}" method="POST"> --}}
                    <div class="row mt-5 ">
                    <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
                        <input type="text" class="form-control" placeholder="Su nombre" name="nombre" required>
                    </div>
                    <div class="col-12 col-sm-6 py-2 wow fadeInRight">
                        {{-- <input type="text" class="form-control" placeholder="Correo electrónico.." name="email"> --}}
                        {!! Form::email('email', null, array('placeholder' => 'Email','class' => 'form-control', 'required')) !!}
                    </div>
                    <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
                        <input type="date" class="form-control" name="fecha_cita" required>
                    </div>
                    <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
                        <select name="especialidad" id="departement" class="custom-select" required>
                          <option value="Medicina Interna">Medicina Interna</option>
                          <option value="Medicina General">Medicina General</option>
                          <option value="Cardiologo">Cardiólogo</option>
                          <option value="Odontologo">Odontólogo</option>
                          <option value="Neurologia">Neurología</option>
                          <option value="Traumatologo">Traumatólogo</option>
                          <option value="otro">Otro</option>
                        </select>
                    </div>
                    <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                        <input type="text" class="form-control" placeholder="Teléfono..." name="telefono" required>
                    </div>
                    <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                        <textarea name="mensaje" id="message" class="form-control" rows="6" placeholder="Esciba un mensaje.."></textarea>
                    </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 wow zoomIn">Solicitar</button>
                {!! Form::close() !!}
                {{-- </form> --}}
            </div>
        </div>
    </div>
  </div> 
  <!-- Fin Formulario Nueva Cita -->
@endsection