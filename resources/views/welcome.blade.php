<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <link rel="stylesheet" href="{{ asset('assets/css/maicons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel/css/owl.carousel.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/animate/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">
  <script src="https://kit.fontawesome.com/13d4eb0966.js" crossorigin="anonymous"></script>
</head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header>
    <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 text-sm">
            <div class="site-info">
              <a href="#"><span class="mai-call text-primary"></span> +58 416 959 0218</a>
              <span class="divider">|</span>
              <a href="#"><span class="mai-mail text-primary"></span> info@rapimed.online</a>
            </div>
          </div>
          <div class="col-sm-4 text-right text-sm">
            <div class="social-mini-button">
              <a href="#"><span class="mai-logo-facebook-f"></span></a>
              <a href="#"><span class="mai-logo-twitter"></span></a>
              <a href="#"><span class="mai-logo-dribbble"></span></a>
              <a href="#"><span class="mai-logo-instagram"></span></a>
            </div>
          </div>
        </div> <!-- .row -->
      </div> <!-- .container -->
    </div> <!-- .topbar -->

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <img src="{{ asset('img/fav-ico.png') }}" alt="">
        <a class="navbar-brand" href="#"><span class="text-primary" style="margin-left: 5px">Rapi</span>Med</a>

        <form action="#">
          <div class="input-group input-navbar">
            <div class="input-group-prepend">
              <span class="input-group-text" id="icon-addon1"><span class="mai-search"></span></span>
            </div>
            <input type="text" class="form-control" placeholder="¿Cómo le podemos ayudar?" aria-label="Username" aria-describedby="icon-addon1">
          </div>
        </form>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="doctors.html">Doctores</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="blog.html">Servicios</a>
              </li>
            <li class="nav-item">
              <a class="nav-link" href="blog.html">Blog</a>
            </li>
            @if (Route::has('login'))
                    @auth
                    <li class="nav-item">
                        <a href="{{ url('/home') }}" class="btn btn-primary ml-lg-3">Home</a>
                    </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-primary ml-lg-3">Log in</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="btn btn-secondary ml-lg-3">Register</a>
                            </li>
                        @endif
                    @endauth
            @endif
          </ul>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>

  <div class="page-hero bg-image overlay-dark" style="background-image: url({{ asset('img/portada.jpg)') }};">
    <div class="hero-section">
      <div class="container text-center wow zoomIn">
        <h1 class="display-4">Profesionales de la salud a un click</h1>
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
            <p class="text-grey mb-4">Afiliantote a <b>RapiMed</b>, tendrás total acceso (Full Access) a nuestros servicios. Asignación de consultas médicas especializadas presenciales, a domicilio u online; asignadas por geolocalización.</p>
            <a href="about.html" class="btn btn-primary">Regístrate</a>
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
        <div class="item">
          <div class="card-doctor">
            <div class="header">
              <img src="{{ asset('assets/img/doctors/doctor_1.jpg') }}" alt="">
              <div class="meta">
                <a href="#" title="Agenda una cita"><i class="fa-regular fa-calendar-check"></i></a>
                <a href="#" title="Habla con un asesor"><span class="mai-logo-whatsapp"></span></a>
              </div>
            </div>
            <div class="body">
              <p class="text-xl mb-0">Dr. Stein Albert</p>
              <span class="text-sm text-grey">Cardiology</span>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="card-doctor">
            <div class="header">
              <img src="{{ asset('assets/img/doctors/doctor_2.jpg') }}" alt="">
              <div class="meta">
                <a href="#"><span class="mai-call"></span></a>
                <a href="#"><span class="mai-logo-whatsapp"></span></a>
              </div>
            </div>
            <div class="body">
              <p class="text-xl mb-0">Dr. Alexa Melvin</p>
              <span class="text-sm text-grey">Dental</span>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="card-doctor">
            <div class="header">
              <img src="{{ asset('assets/img/doctors/doctor_3.jpg') }}" alt="">
              <div class="meta">
                <a href="#"><span class="mai-call"></span></a>
                <a href="#"><span class="mai-logo-whatsapp"></span></a>
              </div>
            </div>
            <div class="body">
              <p class="text-xl mb-0">Dr. Rebecca Steffany</p>
              <span class="text-sm text-grey">General Health</span>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="card-doctor">
            <div class="header">
              <img src="{{ asset('assets/img/doctors/doctor_3.jpg') }}" alt="">
              <div class="meta">
                <a href="#"><span class="mai-call"></span></a>
                <a href="#"><span class="mai-logo-whatsapp"></span></a>
              </div>
            </div>
            <div class="body">
              <p class="text-xl mb-0">Dr. Rebecca Steffany</p>
              <span class="text-sm text-grey">General Health</span>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="card-doctor">
            <div class="header">
              <img src="{{ asset('assets/img/doctors/doctor_3.jpg') }}" alt="">
              <div class="meta">
                <a href="#"><span class="mai-call"></span></a>
                <a href="#"><span class="mai-logo-whatsapp"></span></a>
              </div>
            </div>
            <div class="body">
              <p class="text-xl mb-0">Dr. Rebecca Steffany</p>
              <span class="text-sm text-grey">General Health</span>
            </div>
          </div>
        </div>
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
          <a href="blog.html" class="btn btn-primary">Read More</a>
        </div>

      </div>
    </div>
  </div> <!-- .page-section -->

  <div class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h1 class="text-center wow fadeInUp">Agendar una cita</h1>
                <p>A través de este formulario podrá solicitar una cita con uno de nuestros especialistas. La fecha que coloque, será referencial y estará sujeta de verificación de disponibilidad por parte de nuestros especialistas. Tenga cuidado con los datos que nos suministra ya que por ese medio le notificaremos cuando su cita sea aprobada.</p>
                <p>En RapiMed somos muy cuidadosos con la información que usted nos entregue; la encriptaremos y solo compartiremos lo datos esenciales con el especialista que se le asigne, para que pueda comunicarse con usted. Su privacidad es un factor MUY IMPORTANTE para nosotros.</p>
            </div>
            <div class="col-sm-8">
                <form class="main-form">
                    <div class="row mt-5 ">
                    <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
                        <input type="text" class="form-control" placeholder="Su nombre">
                    </div>
                    <div class="col-12 col-sm-6 py-2 wow fadeInRight">
                        <input type="text" class="form-control" placeholder="Correo electrónico..">
                    </div>
                    <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
                        <input type="date" class="form-control">
                    </div>
                    <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
                        <select name="departement" id="departement" class="custom-select">
                            <option value="general">Medicina General</option>
                            <option value="cardiology">Cardiólogo</option>
                            <option value="dental">Odontólogo</option>
                            <option value="neurology">Neurología</option>
                            <option value="orthopaedics">Ortopedía</option>
                        </select>
                    </div>
                    <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                        <input type="text" class="form-control" placeholder="Teléfono..">
                    </div>
                    <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                        <textarea name="message" id="message" class="form-control" rows="6" placeholder="Esciba un mensaje.."></textarea>
                    </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3 wow zoomIn">Solicitar</button>
                </form>
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

  <footer class="page-footer">
    <div class="container">
      <div class="row px-md-3">
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>RapiMed</h5>
          <ul class="footer-menu">
            <li><a href="#">Nosotros</a></li>
            <li><a href="#">Especialistas</a></li>
            <li><a href="#">Telemedicina</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Servicios</a></li>
            <li><a href="#">Únete como especialista</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Legal</h5>
          <ul class="footer-menu">
            <li><a href="#">Terminos y condiciones</a></li>
            <li><a href="#">Privacidad</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Partner's</h5>
          <ul class="footer-menu">
            <li><a href="#">Rapi-Fitness</a></li>
            <li><a href="#">Rapi-Medicinas</a></li>
            <li><a href="#">Rapi-Lab's</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Contacto</h5>
          <p class="footer-link mt-2">Caracas - Venezuela</p>
          <a href="#" class="footer-link">+58 416 959 0218</a>
          <a href="#" class="footer-link">info@rapimed.online</a>

          <h5 class="mt-3">Social Media</h5>
          <div class="footer-sosmed mt-3">
            <a href="#" target="_blank"><span class="mai-logo-facebook-f"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-twitter"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-google-plus-g"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-instagram"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-linkedin"></span></a>
          </div>
        </div>
      </div>

      <hr>

      <p id="copyright">Copyright &copy; 2023 <a href="https://quantlas.tech/" target="_blank">Quantlas.tech</a>. All right reserved</p>
    </div>
  </footer>

<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('assets/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>

<script src="{{ asset('assets/vendor/wow/wow.min.js') }}"></script>

<script src="{{ asset('assets/js/theme.js') }}"></script>

</body>
</html>
