@extends('layouts.page')
@section('content')
<style>
    .photo-content .cover-photo {
      background-image: url("{{ asset('thumbnail/profile/' . $data['portada']) }}");
    }
</style>
@php
    $hoy = date('Y-m-d');
@endphp
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body conten-profile">
            <div class="container-fluid">
                
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12 pb-4">
                        <div class="profile card card-body px-3 pt-3 pb-0">
                            <div class="profile-head">
                                <div class="photo-content">
                                    <div class="cover-photo"></div>
                                </div>
                                <div class="profile-info">
									<div class="profile-photo">
										<img src="{{ asset('thumbnail/profile/' . $data['avatar']) }}" class="img-fluid rounded-circle" alt="">
									</div>
									<div class="profile-details">
										<div class="profile-name px-3 pt-4">
											<h1 class="text-primary mb-0">{{ $data['degree'] }} {{ $data['nombre'] }}</h1>
											<h5>{{ $data['especialidad'] }}</h5>
										</div>
										{{-- <div class="profile-email px-2 pt-2">
											<h4 class="text-muted mb-0">info@example.com</h4>
											<p>Email</p>
										</div> --}}
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-tab">
                                    <div class="custom-tab-1">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item"><a href="#about-me" data-toggle="tab" class="nav-link active show">Sobre mi</a>
                                            </li>
                                            @auth
                                            <li class="nav-item"><a href="#appoiment" data-toggle="tab" class="nav-link">Solicitar cita</a>
                                            </li>
                                            @else
                                            <li class="nav-item"><a href="javascript:void()" data-toggle="modal" data-target="#registerModal" class="nav-link">Solicitar cita</a>
                                            </li>
                                            @endauth
                                            <li class="nav-item"><a href="#my-posts" data-toggle="tab" class="nav-link">Posts  <span class="badge badge-secondary" style="font-size: 10px">Pronto</span></a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="my-posts" class="tab-pane fade">
                                                <div class="my-post-content pt-3">
                                                    @can('specialist-view')
                                                    <div class="post-input">
                                                        <textarea name="textarea" id="textarea" cols="30" rows="5" class="form-control bg-transparent" placeholder="Please type what you want...."></textarea> 
														<a href="javascript:void()" class="btn btn-primary light px-3"><i class="fa fa-link"></i> </a>
                                                        <a href="javascript:void()" class="btn btn-primary light mr-1 px-3"><i class="fa fa-camera"></i> </a><a href="javascript:void()" class="btn btn-primary">Post</a>
                                                    </div>
                                                    @endcan
                                                    <div class="profile-uoloaded-post border-bottom-1 pb-5">
                                                        <img src="{{ asset('assets/images/profile/8.jpg') }}" alt="" class="img-fluid">
														<a class="post-title" href="post-details.html"><h3 class="text-black">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet.</h3></a>
                                                        <p>Donec rutrum mattis egestas. Integer a lectus nibh. Sed fringilla quam nec dui vehicula mattis. Nullam porttitor dui ut mi laoreet pellentesque. Maecenas congue est elit, ac finibus purus imperdiet ut. Curabitur in vulputate tortor. Fusce eget viverra felis, ut sollicitudin sapien.</p>
                                                        <button class="btn btn-primary mr-2"><span class="mr-2"><i
                                                                    class="fa fa-heart"></i></span>Like</button>
                                                        <button class="btn btn-secondary"  data-toggle="modal" data-target="#replyModal"><span class="mr-2"><i
                                                                    class="fa fa-reply"></i></span>Reply</button>
                                                    </div>
                                                    <div class="profile-uoloaded-post border-bottom-1 pb-5">
                                                        <img src="{{ asset('assets/images/profile/9.jpg') }}" alt="" class="img-fluid">
														<a class="post-title" href="post-details.html"><h3 class="text-black">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet.</h3></a>
                                                        <p>Donec rutrum mattis egestas. Integer a lectus nibh. Sed fringilla quam nec dui vehicula mattis. Nullam porttitor dui ut mi laoreet pellentesque. Maecenas congue est elit, ac finibus purus imperdiet ut. Curabitur in vulputate tortor. Fusce eget viverra felis, ut sollicitudin sapien.</p>
                                                        <button class="btn btn-primary mr-2"><span class="mr-2"><i
                                                                    class="fa fa-heart"></i></span>Like</button>
                                                        <button class="btn btn-secondary"  data-toggle="modal" data-target="#replyModal"><span class="mr-2"><i
                                                                    class="fa fa-reply"></i></span>Reply</button>
                                                    </div>
                                                    <div class="profile-uoloaded-post pb-3">
                                                        <img src="{{ asset('assets/images/profile/8.jpg') }}" alt="" class="img-fluid">
														<a class="post-title" href="post-details.html"><h3 class="text-black">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet.</h3></a>
                                                        <p>Donec rutrum mattis egestas. Integer a lectus nibh. Sed fringilla quam nec dui vehicula mattis. Nullam porttitor dui ut mi laoreet pellentesque. Maecenas congue est elit, ac finibus purus imperdiet ut. Curabitur in vulputate tortor. Fusce eget viverra felis, ut sollicitudin sapien.</p>
                                                        <button class="btn btn-primary mr-2"><span class="mr-2"><i
                                                                    class="fa fa-heart"></i></span>Like</button>
                                                        <button class="btn btn-secondary"  data-toggle="modal" data-target="#replyModal"><span class="mr-2"><i
                                                                    class="fa fa-reply"></i></span>Reply</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="about-me" class="tab-pane fade active show">
                                                <div class="profile-about-me">
                                                    <div class="pt-4 border-bottom-1 pb-3">
                                                        <h4 class="text-primary">Sobre mi</h4>
                                                        <p class="mb-2">{{ $data['historial'] }}</p>
                                                    </div>
                                                </div>
                                                <div class="profile-skills mb-5">
                                                    <h4 class="text-primary mb-2">Tipo de consulta</h4>
                                                    @if ($data['tc_domicilio'] == true)
                                                        @auth
                                                            <a href="javascript:void()" class="btn btn-primary light btn-xs mb-1" data-toggle="modal" data-target="#sendMessageModal"><i class="fa-solid fa-house-medical-circle-check"></i> Domicilio</a>
                                                        @else
                                                            <a href="javascript:void()" class="btn btn-primary light btn-xs mb-1" data-toggle="modal" data-target="#registerModal"><i class="fa-solid fa-house-medical-circle-check"></i> Domicilio</a>
                                                        @endauth
                                                    @endif
                                                    @if ($data['tc_virtual'] == true)
                                                        @auth
                                                            <a href="javascript:void()" class="btn btn-primary light btn-xs mb-1" data-toggle="modal" data-target="#sendMessageModal"><i class="fa-solid fa-house-medical-circle-check"></i> Virtual</a>
                                                        @else
                                                            <a href="javascript:void()" class="btn btn-primary light btn-xs mb-1" data-toggle="modal" data-target="#registerModal"><i class="fa-solid fa-house-medical-circle-check"></i> Virtual</a>
                                                        @endauth
                                                    @endif
                                                    @if ($data['tc_consultorio'] == true)
                                                        @auth
                                                            <a href="javascript:void()" class="btn btn-primary light btn-xs mb-1" data-toggle="modal" data-target="#sendMessageModal"><i class="fa-solid fa-house-medical-circle-check"></i> Consultorio</a>
                                                        @else
                                                            <a href="javascript:void()" class="btn btn-primary light btn-xs mb-1" data-toggle="modal" data-target="#registerModal"><i class="fa-solid fa-house-medical-circle-check"></i> Consultorio</a>
                                                        @endauth
                                                    
                                                    @endif
                                                </div>
                                                <div class="profile-personal-info">
                                                    <h4 class="text-primary mb-4">Información Personal</h4>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3">
                                                            <h5 class="f-w-500 text-muted">Nombre <span class="pull-right">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-sm-9"><h5>{{ $data['nombre'] }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3">
                                                            <h5 class="f-w-500 text-muted">Email <span class="pull-right">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-sm-9"><h5>{{ $data['email'] }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3">
                                                            <h5 class="f-w-500 text-muted">Especialidad <span class="pull-right">:</span></h5>
                                                        </div>
                                                        <div class="col-sm-9"><h5>{{ $data['especialidad'] }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3">
                                                            <h5 class="f-w-500 text-muted">Edad <span class="pull-right">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-sm-9"><h5>{{ $data['dob'] }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3">
                                                            <h5 class="f-w-500 text-muted">Dirección <span class="pull-right">:</span></h5>
                                                        </div>
                                                        <div class="col-sm-9"><h5>{{ $data['direccion'] }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3">
                                                            <h5 class="f-w-500 text-muted">Ciudad <span class="pull-right">:</span></h5>
                                                        </div>
                                                        <div class="col-sm-9"><h5>{{ $data['ciudad'] }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3">
                                                            <h5 class="f-w-500 text-muted">Estado <span class="pull-right">:</span></h5>
                                                        </div>
                                                        <div class="col-sm-9"><h5>{{ $data['estado'] }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3">
                                                            <h5 class="f-w-500 text-muted">Años de experiencia <span class="pull-right">:</span></h5>
                                                        </div>
                                                        <div class="col-sm-9"><h5>{{ $data['dog'] }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--**********************************
                                                Form Cita start
                                            ***********************************-->
                                            <div id="appoiment" class="tab-pane fade">
                                                <div class="pt-3">
                                                    <div class="settings-form">
                                                        <h4 class="text-primary">Solicitar una cita</h4>
                                                        {!! Form::open(array('route' => 'citas.store','method'=>'POST')) !!}
                                                        <input type="text" name="specialist_id" value="{{ $data['specialist_id'] }}" hidden>
                                                        <div class="form-group">
                                                            <label class="text-black font-w500">Fecha de cita</label>
                                                            {!! Form::date('fecha_cita', null, array('placeholder' => 'Fecha de la cita','class' => 'form-control', 'min' => $hoy)) !!}
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="text-black font-w500">Hora de cita</label>
                                                            {!! Form::time('hora_cita', null, array('placeholder' => 'Hora de la cita','class' => 'form-control', 'min' => '08:00', 'max' => '17:00')) !!}
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="text-black font-w500">Tipo de cita</label>
                                                            @php
                                                                $optionsTipo = [
                                                                    'Domicilio' => 'En mi casa',
                                                                    'Consultorio' => 'En el consultorio',
                                                                    'Virtual' => 'Virtual'
                                                                ];
                                                            @endphp
                                                            {!! Form::select('tipo', $optionsTipo,[], array('placeholder' => 'Seleccione el tipo de cita','class' => 'form-control','simple')) !!}
                                                        </div>

                                                        {!! Form::text('user_id', $data['user_id'], array('hidden')) !!}
                                                        <small>Le notificaremos cuando le sea asignado un especialista y sea aceptada su solicitud.</small>
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary">Solicitar</button>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <!--**********************************
                                                Form Cita end
                                            ***********************************-->
                                        </div>
                                    </div>
									<!-- Modal -->
									<div class="modal fade" id="replyModal">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Post Reply</h5>
													<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
												</div>
												<div class="modal-body">
													<form>
														<textarea class="form-control" rows="4">Message</textarea>
													</form>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
													<button type="button" class="btn btn-primary">Reply</button>
												</div>
											</div>
										</div>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-statistics mb-5">
                                    <div class="text-center">
                                        <div class="row">
                                            <div class="col">
                                                <h3 class="m-b-0"><i class="fa-solid fa-hand-holding-heart" style="color: rgb(219, 135, 255)"></i><br>{{ $data['pacientes'] }}</h3> <span>Pacientes</span>
                                            </div>
                                            <div class="col">
                                                <h3 class="m-b-0"><i class="fa-solid fa-heart" style="color: red"></i><br>{{ $data['score'] }}</h3><span>Puntuación</span>
                                            </div>
                                            {{-- <div class="col">
                                                <h3 class="m-b-0"><i class="fa-solid fa-share"  style="color: rgb(51, 0, 255)"></i><br>45</h3><span>Seguidores</span>
                                            </div> --}}
                                        </div>
                                        <div class="mt-4">
											<a href="javascript:void()" class="btn btn-primary mb-1 mr-1">Seguir <span class="badge badge-secondary" style="font-size: 10px">Pronto</span></a> 
                                            @auth
                                            <a href="javascript:void()" class="btn btn-primary mb-1" data-toggle="modal" data-target="#sendMessageModal">Pedir cita</a>
                                            @else
                                            <a href="javascript:void()" class="btn btn-primary mb-1" data-toggle="modal" data-target="#registerModal">Pedir cita</a>
                                            @endauth
                                        </div>
                                    </div>
									<!--**********************************
                                        Modal Form Cita start
                                    ***********************************-->
									<div class="modal fade" id="sendMessageModal">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Solicitar una cita</h5>
													<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
												</div>
												<div class="modal-body">
                                                    {!! Form::open(array('route' => 'citas.store','method'=>'POST')) !!}
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <img src="{{ asset('thumbnail/profile/' . $data['avatar']) }}" class="img-fluid rounded-circle" alt="">
                                                            </div>
                                                            <div class="col-sm-8">
                                                                Especialista: 
                                                                <h4>{{ $data['degree'] . " " . $data['nombre'] }}</h4>
                                                                <small>{{ $data['especialidad'] }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="specialist_id" value="{{ $data['specialist_id'] }}" hidden>
                                                    <div class="form-group">
                                                        <label class="text-black font-w500">Fecha de cita</label>
                                                        {!! Form::date('fecha_cita', null, array('placeholder' => 'Fecha de la cita','class' => 'form-control', 'min' => $hoy)) !!}
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="text-black font-w500">Hora de cita</label>
                                                        {!! Form::time('hora_cita', null, array('placeholder' => 'Hora de la cita','class' => 'form-control', 'min' => '08:00', 'max' => '17:00')) !!}
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="text-black font-w500">Tipo de cita</label>
                                                        @php
                                                            $optionsTipo = [
                                                                'Domicilio' => 'En mi casa',
                                                                'Consultorio' => 'En el consultorio',
                                                                'Virtual' => 'Virtual'
                                                            ];
                                                        @endphp
                                                        {!! Form::select('tipo', $optionsTipo,[], array('placeholder' => 'Seleccione el tipo de cita','class' => 'form-control','simple')) !!}
                                                    </div>

                                                    {!! Form::text('user_id', $data['user_id'], array('hidden')) !!}
                                                    <small>Le notificaremos cuando le sea asignado un especialista y sea aceptada su solicitud.</small>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">Solicitar</button>
                                                    </div>
                                                    {!! Form::close() !!}
												</div>
											</div>
										</div>
									</div>
                                    <!--**********************************
                                        Modal Form Cita end
                                    ***********************************-->
                                    
                                    <!--**********************************
                                        Modal Form Registro start
                                    ***********************************-->
                                    <div class="modal fade" id="registerModal">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Inicie sesión</h5>
													<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
												</div>
												<div class="modal-body">
                                                    <form method="POST" action="{{ route('login') }}">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label class=""><strong>Email</strong></label>
                                                            {{-- <input type="email" class="form-control" value="hello@example.com"> --}}
                                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label class=""><strong>Password</strong></label>
                                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                                            <div class="form-group">
                                                            <div class="custom-control custom-checkbox ml-1">
                                                                    <input class="custom-control-input" type="checkbox" name="remember" id="basic_checkbox_1" {{ old('remember') ? 'checked' : '' }}>
                                                                    <label class="custom-control-label" for="basic_checkbox_1">
                                                                        {{ __('Recordarme') }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <a class="" href="{{ route('password.request') }}">¿Olvidó su contraseña?</a>
                                                            </div>
                                                        </div>
                                                        <div class="text-center">
                                                            
                                                            <button type="submit" class="btn bg-secondary text-white btn-block">
                                                                {{ __('Iniciar sesión') }}
                                                            </button>
                                                        </div>
                                                    </form>

                                                    <hr>
                                                    <div class="modal-header bg-light">
                                                        <h5 class="modal-title">Regístrese</h5>
                                                    </div>
                                                    <div class="bg-light p-4">
                                                    {{-- Registrar --}}
													<form method="POST" action="{{ route('register') }}">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label class="mb-1"><strong>Nombres y Apellidos</strong></label>
                                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="mb-1"><strong>Email</strong></label>
                                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="ejemplo@correo.com" required autocomplete="email">
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="mb-1"><strong>Contraseña</strong></label>
                                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="mb-1"><strong>Repita contraseña</strong></label>
                                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                        </div>
                                                        <input type="text" name="roles" value="Customer" hidden>
                                                        <div class="text-center mt-4">
                                                            <button type="submit" class="btn bg-secondary text-white btn-block">
                                                                {{ __('Registrar') }}
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
												</div>
											</div>
										</div>
									</div>
                                    <!--**********************************
                                        Modal Form Registro end
                                    ***********************************-->
                                </div>

                                <hr>

                                <div class="profile-blog mb-5">
                                    <h5 class="text-primary d-inline">Otros Especialistas
                                        <?php

                                        //var_dump($otrosespecialistas);

                                        ?>
                                        
                                        @for ($i = 0; $i < count($otros); $i++)
          
                                        <div class="item">
                                            <div class="card-doctor">
                                            <div class="header">
                                                <img src="/thumbnail/profile/{{ $otros[$i]['avatar'] }}" alt="">
                                                <div class="meta">
                                                <a href="{{ route('perfil', $otros[$i]['user_id']) }}" title="Ver perfil"><i class="fa-regular fa-eye"></i></a>
                                                </div>
                                            </div>
                                            <div class="body">
                                                <p class="text-xl mb-0">{{ $otros[$i]['degree'] }}. {{ $otros[$i]['nombre'] }}</p>
                                                <span class="text-sm text-grey">{{ $otros[$i]['especialidad'] }}</span>
                                            </div>
                                            </div>
                                        </div>

                                        @endfor
                                        <small><a href="{{ route('doctors') }}" class="pull-right f-s-8">Ver todos..</a></small>
                                </div>

                                <hr>

                                <div class="profile-news">
                                    <h5 class="text-primary d-inline">Últimas noticias</h5> <span class="badge badge-secondary" style="font-size: 10px">Pronto</span>
                                    <div class="media pt-3 pb-3">
                                        <img src="{{ asset('assets/images/profile/5.jpg') }}" alt="image" class="mr-3 rounded" width="75">
                                        <div class="media-body">
                                            <h5 class="m-b-5"><a href="post-details.html" class="text-black">Neque porro quisquam...</a></h5>
                                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum eros eu lectus ultricies venenatis...</p>
                                        </div>
                                    </div>
                                    <div class="media pt-3 pb-3">
                                        <img src="{{ asset('assets/images/profile/6.jpg') }}" alt="image" class="mr-3 rounded" width="75">
                                        <div class="media-body">
                                            <h5 class="m-b-5"><a href="post-details.html" class="text-black">Neque porro quisquam...</a></h5>
                                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum eros eu lectus ultricies venenatis...</p>
                                        </div>
                                    </div>
                                    <div class="media pt-3 pb-3">
                                        <img src="{{ asset('assets/images/profile/7.jpg') }}" alt="image" class="mr-3 rounded" width="75">
                                        <div class="media-body">
                                            <h5 class="m-b-5"><a href="post-details.html" class="text-black">Neque porro quisquam...</a></h5>
                                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum eros eu lectus ultricies venenatis...</p>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="profile-interest mb-5">
                                    <h5 class="text-primary d-inline">Interest</h5>
                                    <div class="row mt-4 sp4" id="lightgallery">
										<a href="images/profile/2.jpg" data-exthumbimage="images/profile/2.jpg" data-src="{{ asset('assets/images/profile/2.jpg') }}" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
											<img src="{{ asset('assets/images/profile/2.jpg') }}" alt="" class="img-fluid">
										</a>
										<a href="images/profile/3.jpg" data-exthumbimage="images/profile/3.jpg" data-src="{{ asset('assets/images/profile/3.jpg') }}" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
											<img src="{{ asset('assets/images/profile/3.jpg') }}" alt="" class="img-fluid">
										</a>
										<a href="images/profile/4.jpg" data-exthumbimage="images/profile/4.jpg" data-src="{{ asset('assets/images/profile/4.jpg') }}" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
											<img src="{{ asset('assets/images/profile/4.jpg') }}" alt="" class="img-fluid">
										</a>
										<a href="images/profile/3.jpg" data-exthumbimage="images/profile/3.jpg" data-src="{{ asset('assets/images/profile/3.jpg') }}" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
											<img src="{{ asset('assets/images/profile/3.jpg') }}" alt="" class="img-fluid">
										</a>
										<a href="images/profile/4.jpg" data-exthumbimage="images/profile/4.jpg" data-src="{{ asset('assets/images/profile/4.jpg') }}" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
											<img src="{{ asset('assets/images/profile/4.jpg') }}" alt="" class="img-fluid">
										</a>
										<a href="images/profile/2.jpg" data-exthumbimage="images/profile/2.jpg" data-src="{{ asset('assets/images/profile/2.jpg') }}" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
											<img src="{{ asset('assets/images/profile/2.jpg') }}" alt="" class="img-fluid">
										</a>
                                    </div>
                                </div> --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->
@endsection