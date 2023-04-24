@extends('layouts.page')
@section('content')
  <div class="page-hero bg-image overlay-dark" style="background-image: url({{ asset('img/portada.jpg)') }};">
    <div class="hero-section">
      <div class="container text-center wow zoomIn">
        <h1 class="display-4">Profesionales de la salud a unos clicks</h1>
        {{-- <span class="subhead">a un click</span><br> --}}
        <a href="#" class="btn btn-secondary">¿Cómo le podemos ayudar?</a>
      </div>
    </div>
  </div>

  <div class="bg-light">
    <div class="page-section py-3 mt-md-n5 custom-index">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-4 py-3 py-md-0">
            <div class="card-service wow fadeInUp">
              <div class="circle-shape bg-secondary text-white">
                <span class="mai-chatbubbles-outline"></span>
              </div>
              <p><span>Habla</span> con un doctor</p>
            </div>
          </div>
          <div class="col-md-4 py-3 py-md-0">
            <div class="card-service wow fadeInUp">
              <div class="circle-shape bg-primary text-white">
                <span class="mai-shield-checkmark"></span>
              </div>
              <p>Protección <span>Rapi</span>Med</p>
            </div>
          </div>
          <div class="col-md-4 py-3 py-md-0">
            <div class="card-service wow fadeInUp">
              <div class="circle-shape bg-accent text-white">
                <span class="mai-basket"></span>
              </div>
              <p>Telemedicina <span>Rapi</span>Med</p>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- .page-section -->

    <div class="page-section pb-0">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 py-3 wow fadeInUp">
            <h1>Bienvenido a tu<br>Asistente de Salud</h1>
            <p class="text-grey mb-4"><b>RapiMed</b> conecta los mundos físico y digital con solo tocar un botón. Porque creemos en un mundo accesible. Para que puedas moverte y ganar con seguridad, de una manera que sea sostenible para nuestro planeta. Sin importar género, raza, religión, habilidades u orientación sexual; defendemos su derecho a moverse libremente, sin miedo.</p>
            <p class="text-grey mb-4">Afiliandote a <b>RapiMed</b>, tendrás total acceso (Full Access) a nuestros servicios. Asignación de consultas médicas especializadas presenciales, a domicilio u online, asignadas por geolocalización.</p>
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
  </div> <!-- .bg-light -->

  <div class="page-section">
    <div class="container">
      <h1 class="text-center mb-5 wow fadeInUp">Nuestros especialistas</h1>

      <div class="owl-carousel wow fadeInUp" id="doctorSlideshow">

        @for ($i = 0; $i < count($data); $i++)
          
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

        @endfor
      </div>
    </div>
  </div>

  <div class="page-section bg-light">
    <div class="container">
      <h1 class="text-center wow fadeInUp">Últimos artículos</h1>
      <div class="row mt-5">
        <div class="col-lg-4 py-2 wow zoomIn">
          <div class="card-blog">
            <div class="header">
              <div class="post-category">
                <a href="#">Covid19</a>
              </div>
              <a href="blog-details.html" class="post-thumb">
                <img src="{{ asset('assets/img/blog/blog_1.jpg') }}" alt="">
              </a>
            </div>
            <div class="body">
              <h5 class="post-title"><a href="blog-details.html">List of Countries without Coronavirus case</a></h5>
              <div class="site-info">
                <div class="avatar mr-2">
                  <div class="avatar-img">
                    <img src="{{ asset('assets/img/person/person_1.jpg') }}" alt="">
                  </div>
                  <span>Roger Adams</span>
                </div>
                <span class="mai-time"></span> 1 week ago
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 py-2 wow zoomIn">
          <div class="card-blog">
            <div class="header">
              <div class="post-category">
                <a href="#">Covid19</a>
              </div>
              <a href="blog-details.html" class="post-thumb">
                <img src="{{ asset('assets/img/blog/blog_2.jpg') }}" alt="">
              </a>
            </div>
            <div class="body">
              <h5 class="post-title"><a href="blog-details.html">Recovery Room: News beyond the pandemic</a></h5>
              <div class="site-info">
                <div class="avatar mr-2">
                  <div class="avatar-img">
                    <img src="{{ asset('assets/img/person/person_1.jpg') }}" alt="">
                  </div>
                  <span>Roger Adams</span>
                </div>
                <span class="mai-time"></span> 4 weeks ago
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 py-2 wow zoomIn">
          <div class="card-blog">
            <div class="header">
              <div class="post-category">
                <a href="#">Covid19</a>
              </div>
              <a href="blog-details.html" class="post-thumb">
                <img src="{{ asset('assets/img/blog/blog_3.jpg') }}" alt="">
              </a>
            </div>
            <div class="body">
              <h5 class="post-title"><a href="blog-details.html">What is the impact of eating too much sugar?</a></h5>
              <div class="site-info">
                <div class="avatar mr-2">
                  <div class="avatar-img">
                    <img src="{{ asset('assets/img/person/person_2.jpg') }}" alt="">
                  </div>
                  <span>Diego Simmons</span>
                </div>
                <span class="mai-time"></span> 2 months ago
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 text-center mt-4 wow zoomIn">
          <a href="#" class="btn btn-primary">Leer mas</a>
        </div>

      </div>
    </div>
  </div> <!-- .page-section -->
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
  </div> <!-- .page-section -->

  {{-- <div class="page-section banner-home bg-image" style="background-image: url({{ asset('assets/img/banner-pattern.svg') }});">
    <div class="container py-5 py-lg-0">
      <div class="row align-items-center">
        <div class="col-lg-4 wow zoomIn">
          <div class="img-banner d-none d-lg-block">
            <img src="{{ asset('assets/img/mobile_app.png') }}" alt="">
          </div>
        </div>
        <div class="col-lg-8 wow fadeInRight">
          <h1 class="font-weight-normal mb-3">Get easy access of all features using One Health Application</h1>
          <a href="#"><img src="{{ asset('assets/img/google_play.svg') }}" alt=""></a>
          <a href="#" class="ml-2"><img src="{{ asset('assets/img/app_store.svg') }}" alt=""></a>
        </div>
      </div>
    </div>
  </div> <!-- .banner-home --> --}}
@endsection
