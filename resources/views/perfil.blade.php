@extends('layouts.page')
@section('content')
<style>
    .photo-content .cover-photo {
      background-image: url("{{ asset('thumbnail/profile/' . $data['portada']) }}");
    }
</style>
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
                                            <li class="nav-item"><a href="#appoiment" data-toggle="tab" class="nav-link">Solicitar cita</a>
                                            </li>
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
                                                    <a href="javascript:void()" class="btn btn-primary light btn-xs mb-1" data-toggle="modal" data-target="#sendMessageModal"><i class="fa-solid fa-house-medical-circle-check"></i> Domicilio</a>
                                                    @endif
                                                    @if ($data['tc_virtual'] == true)
                                                    <a href="javascript:void()" class="btn btn-primary light btn-xs mb-1" data-toggle="modal" data-target="#sendMessageModal"><i class="fa-solid fa-house-medical-circle-check"></i> Virtual</a>
                                                    @endif
                                                    @if ($data['tc_consultorio'] == true)
                                                    <a href="javascript:void()" class="btn btn-primary light btn-xs mb-1" data-toggle="modal" data-target="#sendMessageModal"><i class="fa-solid fa-house-medical-circle-check"></i> Consultorio</a>
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
                                            <div id="appoiment" class="tab-pane fade">
                                                <div class="pt-3">
                                                    <div class="settings-form">
                                                        <h4 class="text-primary">Solicitar una cita</h4>
                                                        {!! Form::open(array('route' => 'citas.store','method'=>'POST')) !!}
                                                        @csrf
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>Nombre *</label>
                                                                    <input type="text" class="form-control" placeholder="Su nombre..." name="nombre" required>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Email *</label>
                                                                    {!! Form::email('email', null, array('placeholder' => 'Email...','class' => 'form-control', 'required')) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>Teléfono *</label>
                                                                    <input type="text" class="form-control" placeholder="Teléfono..." name="telefono" required>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Tipo de consulta</label>
                                                                    <select name="tipo" id="tc" class="custom-select" required>
                                                                        <option value="Virtual" selected>Virtual</option>
                                                                        <option value="Consultorio">Consultorio</option>
                                                                        <option value="Domicilio">Domicilio</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>Ciudad de residencia</label>
                                                                    <input type="text" class="form-control" placeholder="Ciudad..." name="ciudad">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Fecha de la cita *</label>
                                                                    <input type="date" class="form-control" name="fecha_cita" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-12">
                                                                    <label>Describa brevemente su situación de salud</label>
                                                                    <textarea name="mensaje" id="message" class="form-control" rows="6" placeholder="Esciba un mensaje.."></textarea>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="form-group">
                                                                <div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="gridCheck">
																	<label class="custom-control-label" for="gridCheck"> Check me out</label>
																</div>
                                                            </div> --}}
                                                            <input type="text" name="specialist_id" value="{{ $data['specialist_id'] }}" hidden>
                                                            <input type="text" name="especialista" value="{{ $data['email'] }}" hidden>
                                                            <button class="btn btn-primary" type="submit">Solicitar cita</button>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
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
											<a href="javascript:void()" class="btn btn-primary mb-1" data-toggle="modal" data-target="#sendMessageModal">Pedir cita</a>
                                        </div>
                                    </div>
									<!-- Modal -->
									<div class="modal fade" id="sendMessageModal">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Solicitar una cita</h5>
													<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
												</div>
												<div class="modal-body">
													{!! Form::open(array('route' => 'citas.store','method'=>'POST')) !!}
                                                        @csrf
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>Nombre *</label>
                                                                    <input type="text" class="form-control" placeholder="Su nombre..." name="nombre" required>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Email *</label>
                                                                    {!! Form::email('email', null, array('placeholder' => 'Email...','class' => 'form-control', 'required')) !!}
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>Teléfono *</label>
                                                                    <input type="text" class="form-control" placeholder="Teléfono..." name="telefono" required>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Tipo de consulta</label>
                                                                    <select name="tipo" id="tc" class="custom-select" required>
                                                                        <option value="Virtual" selected>Virtual</option>
                                                                        <option value="Consultorio">Consultorio</option>
                                                                        <option value="Domicilio">Domicilio</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>Ciudad de residencia</label>
                                                                    <input type="text" class="form-control" placeholder="Ciudad..." name="ciudad">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>Fecha de la cita *</label>
                                                                    <input type="date" class="form-control" name="fecha_cita" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-12">
                                                                    <label>Describa brevemente su situación de salud</label>
                                                                    <textarea name="mensaje" id="message" class="form-control" rows="6" placeholder="Esciba un mensaje.."></textarea>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="form-group">
                                                                <div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="gridCheck">
																	<label class="custom-control-label" for="gridCheck"> Check me out</label>
																</div>
                                                            </div> --}}
                                                            <input type="text" name="specialist_id" value="{{ $data['specialist_id'] }}" hidden>
                                                            <input type="text" name="especialista" value="{{ $data['email'] }}" hidden>
                                                            <input type="text" name="user_id" value="{{ $data['user_id'] }}" hidden>
                                                            <button class="btn btn-primary" type="submit">Solicitar cita</button>
                                                        {!! Form::close() !!}
												</div>
											</div>
										</div>
									</div>
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