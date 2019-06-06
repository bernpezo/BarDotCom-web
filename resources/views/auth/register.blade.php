@extends('layouts.template')
<!-- CSS session -->
@section('css')
<link rel="stylesheet" href="{{ asset('css/session.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.css') }}">
@endsection
<!-- Fin CSS -->
<!-- Título -->
@section('titulo')
Registro
@endsection
@section('contenido')
    <div class="container">
        <div class="row cuerpo">
            <div class="col-md-4">
                <h1>Bienvenido</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore illum rem neque aspernatur quibusdam eveniet aliquid quidem. Perferendis officiis tempora, expedita dolor, quia laboriosam quod asperiores ex at alias adipisci?</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis dolorem similique non, asperiores pariatur officiis ab quaerat nam deleniti, dolore facere repudiandae magni laborum dolor laboriosam? Iure doloribus consectetur possimus.</p>
            </div>
            <!-- Inicio formulario de registro -->
            <div class="col-md-8">
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="row cuerpo margen-control">
                        <div class="col-md-6 form-group">
                            <h3 class="text-center">Sobre tí</h3>
                            <input type="text" name="nombre" id="nombre" placeholder="Nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}">
                            @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="text" name="apellido" id="apellido" placeholder="Apellido" class="form-control @error('apellido') is-invalid @enderror" value="{{ old('apellido') }}">
                            @error('apellido')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input name="comuna" id="comuna" class="form-control @error('comuna') is-invalid @enderror" value="{{ old('comuna') }}">
                            @error('comuna')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="number" name="telefono" id="telefono" placeholder="Teléfono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}">
                            @error('telefono')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="text" name="fechaNacimiento" id="fechaNacimiento" placeholder="Fecha de Nacimiento" class="form-control @error('fechaNacimiento') is-invalid @enderror" value="{{ old('fechaNacimiento') }}"/>
                        </div>
                        <div class="col-md-6 form-group">
                            <h3 class="text-center">Sobre tu cuenta</h3>
                            <input type="text" name="email" id="email" placeholder="Correo electrónico" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="number" name="nfc" id="nfc" placeholder="Número de tarjeta" class="form-control @error('nfc') is-invalid @enderror" value="{{ old('nfc') }}">
                            @error('nfc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="password" name="password" id="password" placeholder="Contraseña" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="password" name="password_confirmation" id="password-confirm" placeholder="Repita la contraseña" class="form-control">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="{{ route('home') }}" name="btnVolver" id="btnVolver" class="btn btn-info">Volver</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Fin formulario de registro -->
        </div>
    </div>
@endsection
<!-- JS session -->
@section('js')
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/session.js') }}"></script>
@endsection
<!-- Fin jS -->