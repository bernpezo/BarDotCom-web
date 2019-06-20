@extends('layouts.template')
<!-- CSS de Session -->
@section('css')
<link rel="stylesheet" href="{{ asset('css/session.css') }}">
@endsection
<!-- Fin CSS -->
<!-- Título -->
@section('titulo')
Ingreso
@endsection
@section('contenido')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card cuerpo">
                    <div class="card-body">
                        <!-- Inicio formulario de Log-in -->
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <h1 class="text-center">Bienvenido</h1>
                            <div class="form-group margen-control">
                                <input type="text" name="email" id="email" placeholder="Correo electrónico" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input type="password" name="password" id="password" placeholder="Contraseña" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-check form-group">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">Mantener sesión iniciada</label>
                            </div>
                            <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('home') }}" name="btnVolver" id="btnVolver" class="btn btn-info btn-block">Volver</a>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                        <!-- Fin formulario de Log-in -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection