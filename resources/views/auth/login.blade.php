@extends('layouts.app')

@section('content')
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <a href="{{ url('/') }}" style="text-decoration: none">
                                <div class="text-center mb-3">
                                    <img src="{{ asset('img/logo-cabecera.png') }}" alt=""><span style="font-size: 2rem; color: #fff; font-weight: 800;">RapiMed</span>
                                </div>
                                </a>
                                <h4 class="text-center mb-4 text-white">Inicio de sesión</h4>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>Email</strong></label>
                                        {{-- <input type="email" class="form-control" value="hello@example.com"> --}}
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>Password</strong></label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                        <div class="form-group">
                                           <div class="custom-control custom-checkbox ml-1 text-white">
                                                <input class="custom-control-input" type="checkbox" name="remember" id="basic_checkbox_1" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="basic_checkbox_1">
                                                    {{ __('Recordarme') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <a class="text-white" href="#">¿Olvidó su contraseña?</a>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-white text-primary btn-block">
                                            {{ __('Ingresar') }}
                                        </button>

                                        {{-- @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif --}}
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p class="text-white">¿No tiene una cuenta? <a class="text-white" href="{{ route('register') }}">Regístrese</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
