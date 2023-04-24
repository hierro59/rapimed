<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/fav-ico.png') }}">
  <title>{{ config('app.name', 'Rapimed') }}</title>
  <!-- Assets -->
  <link rel="stylesheet" href="{{ asset('assets/css/maicons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel/css/owl.carousel.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/animate/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">
  <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/lightgallery/css/lightgallery.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/mystyles.css') }}" rel="stylesheet">
  <script src="https://kit.fontawesome.com/13d4eb0966.js" crossorigin="anonymous"></script>

  <!-- Metas -->
  @if (Route::currentRouteName() == 'doctors')
  <meta property="og:title" content="Directorio Médico · RapiMed" />
  <meta property="og:description" content="Busca, consigue y contacta fácilmente con un Especialista de la Salud en nuestro amplio directorio. Afiliate gratis y tendrás total acceso a nuestros servicios." />
  <meta property="og:image" content="https://rapimed.website/img/portada-og-v01.webp" />
  @elseif (Route::currentRouteName() == 'perfil')
  <meta property="og:title" content="{{ $data['degree'] . " " . $data['nombre'] . " - " . $data['especialidad'] }} · RapiMed" />
  <meta property="og:description" content="{{ $data['historial'] }} Afiliate gratis y tendrás total acceso a nuestros servicios." />
  <meta property="og:image" content="https://rapimed.website/thumbnail/profile/{{ $data['avatar'] }}" />
  @else
  <meta property="og:title" content="RapiMed · Profesionales de la salud a un click" />
  <meta property="og:description" content="Asignación de consultas médicas especializadas presenciales, a domicilio u online, asignadas por geolocalización. Afiliate gratis y tendrás total acceso a nuestros servicios." />
  <meta property="og:image" content="https://rapimed.website/img/portada-og-v01.webp" />
  @endif
  <meta property="og:type" content="WebApp" />
  <meta property="og:url" content="https://rapimed.website" />
  
  
</head>
<body>
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--*******************
        Header start
    ********************-->
    <header>
        <div class="topbar">
          <div class="container">
            <div class="row">
              <div class="col-sm-8 text-sm">
                <div class="site-info">
                  <a href="https://api.whatsapp.com/send?phone=584169590218&text=Hola%2C%20estuve%20viendo%20Rapimed.website%20%C2%BFMe%20podr%C3%ADa%20ayudar%3F%20"><span class="mai-call text-primary"></span> +58 416 959 0218</a>
                  <span class="divider">|</span>
                  <a href="mailto:info@rapimed.site"><span class="mai-mail text-primary"></span> info@rapimed.site</a>
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
            <a class="navbar-brand" href="{{ route('welcome') }}"><span class="text-primary" style="margin-left: 5px">Rapi</span>Med</a>
    
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
                  <a class="nav-link" href="{{ route('welcome') }}">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('doctors') }}">Doctores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pronto">Servicios</a>
                  </li>
                <li class="nav-item">
                  <a class="nav-link" href="blog">Blog</a>
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


    <!--*******************
        Header end
    ********************-->

    <!--*******************
        Cuerpo start
    ********************-->
    <div id="main-wrapper">
        {{--<main class="py-4">
            <div class="container"> --}}
                @yield('content')
           {{--  </div>
        </main> --}}
    </div>
    <!--*******************
        Cuerpo end
    ********************-->

    <!--*******************
        Footer start
    ********************-->
    <footer class="page-footer">
        <div class="container">
            <div class="row px-md-3">
            <div class="col-sm-6 col-lg-3 py-3">
                <h5>RapiMed</h5>
                <ul class="footer-menu">
                <li><a href="#about">Nosotros</a></li>
                <li><a href="{{ route('doctors') }}">Especialistas</a></li>
                <li><a href="#pronto">Telemedicina</a></li>
                <li><a href="blog">Blog</a></li>
                <li><a href="#pronto">Servicios</a></li>
                <li><a href="#oronto">Únete como especialista</a></li>
                </ul>
            </div>
            <div class="col-sm-6 col-lg-3 py-3">
                <h5>Legal</h5>
                <ul class="footer-menu">
                <li><a href="#pronto">Terminos y condiciones</a></li>
                <li><a href="#pronto">Privacidad</a></li>
                </ul>
            </div>
            <div class="col-sm-6 col-lg-3 py-3">
                <h5>Partner's</h5>
                <ul class="footer-menu">
                <li><a href="#pronto">Rapi-Fitness</a></li>
                <li><a href="#pronto">Rapi-Medicinas</a></li>
                <li><a href="#pronto">Rapi-Lab's</a></li>
                </ul>
            </div>
            <div class="col-sm-6 col-lg-3 py-3">
                <h5>Contacto</h5>
                <p class="footer-link mt-2">Caracas - Venezuela</p>
                <a href="https://api.whatsapp.com/send?phone=584169590218&text=Hola%2C%20estuve%20viendo%20Rapimed.website%20%C2%BFMe%20podr%C3%ADa%20ayudar%3F%20" class="footer-link">+58 416 959 0218</a>
                <a href="mailto:info@rapimed.site" class="footer-link">info@rapimed.site</a>
    
                <h5 class="mt-3">Social Media</h5>
                <div class="footer-sosmed mt-3">
                <a href="#pronto" target="_blank"><span class="mai-logo-facebook-f"></span></a>
                <a href="#pronto" target="_blank"><span class="mai-logo-twitter"></span></a>
                <a href="#pronto" target="_blank"><span class="mai-logo-google-plus-g"></span></a>
                <a href="#pronto" target="_blank"><span class="mai-logo-instagram"></span></a>
                <a href="#pronto" target="_blank"><span class="mai-logo-linkedin"></span></a>
                </div>
            </div>
            </div>
    
            <hr>
    
            <p id="copyright">Copyright &copy; 2023 <a href="https://quantlas.tech/" target="_blank">Quantlas.tech</a>. All right reserved</p>
        </div>
    </footer>
    <!--*******************
        Footer end
    ********************-->
  <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
  
  <script src="{{ asset('assets/vendor/wow/wow.min.js') }}"></script>
  <script src="{{ asset('assets/js/theme.js') }}"></script>
  <script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
  <script src="{{ asset('assets/js/custom.min.js') }}"></script>
	<script src="{{ asset('assets/js/deznav-init.js') }}"></script>
	<script src="{{ asset('assets/vendor/lightgallery/js/lightgallery-all.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
</body>
</html>
