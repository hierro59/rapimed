<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/fav-ico.png') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Assets -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('vendor/chartist/css/chartist.min.css') }} rel="stylesheet"">
    <link href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
	<link href="{{ asset('vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/13d4eb0966.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <script type="text/javascript">
        function callbackThen(response){
          // read HTTP status
          console.log(response.status);
          // read Promise object
          response.json().then(function(data){
          console.log(data);
          });
        }
        function callbackCatch(error){
          console.error('Error:', error)
        }
      </script>
      {!! htmlScriptTagJsApi([
        'callback_then' => 'callbackThen',
        'callback_catch' => 'callbackCatch'
      ]) !!}
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
    <div id="app">
        <div id="main-wrapper">
            @if(session()->has('success'))
                <div x-data="{ show: true}"
                    x-init="setTimeout(() => show = false, 4000)"
                    x-show="show"
                    class="position-fixed bg-success rounded right-3 text-sm py-2 px-4">
                <p class="m-0">{{ session('success')}}</p>
                </div>
            @endif
            @auth
                @include('layouts.dashboard.navbar')
                @include('layouts.dashboard.sidebar')
                <main class="py-4">
                    <div class="container">
                        @yield('content')
                    </div>
                </main>
            @else
                <main class="py-4">
                    <div class="container">
                        @yield('content')
                    </div>
                </main>
            @endauth
        </div>
    </div>

    <!-- Required vendors -->
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
	<script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
	<script src="{{ asset('vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
	<script src="{{ asset('js/deznav-init.js') }}"></script>

	<!-- Chart piety plugin files -->
    <script src="{{ asset('vendor/peity/jquery.peity.min.js') }}"></script>

	<!-- Apex Chart -->
	<script src="{{ asset('vendor/apexchart/apexchart.js') }}"></script>
	<!-- Dashboard 1 -->
	<script src="{{ asset('js/dashboard/patient-details.js') }}"></script>
</body>
</html>
