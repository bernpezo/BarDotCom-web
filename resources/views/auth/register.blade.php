@extends('layouts.template')
<!-- CSS de session -->
@section('css')
<link rel="stylesheet" href="{{ asset('css/session.css') }}">
<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
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
                            <input type="text" name="nombre" id="nombre" placeholder="Nombre" class="form-control">
                            <input type="text" name="apellido" id="apellido" placeholder="Apellido" class="form-control">
                            <select name="comuna" id="comuna" class="form-control"></select>
                            <input type="number" name="telefono" id="telefono" placeholder="Teléfono" class="form-control">
                            <!-- calendario!! 
                            fecha nacimiento -->
                            
                            
                        </div>
                        <div class="col-md-6 form-group">
                            <h3 class="text-center">Sobre tu cuenta</h3>
                            <input type="text" name="correo" id="correo" placeholder="Correo electrónico" class="form-control">
                            <input type="number" name="tarjeta" id="tarjeta" placeholder="Número de tarjeta" class="form-control">
                            <input type="password" name="pass" id="pass" placeholder="Contraseña" class="form-control">
                            <input type="password" name="pass2" id="pass2" placeholder="Repita la contraseña" class="form-control">
                            <a href="#" name="btnRegistrar" id="btnRegistrar" class="btn btn-success">Guardar</a>
                            <a href="{{ route('home') }}" name="btnVolver" id="btnVolver" class="btn btn-info">Volver</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Fin formulario de registro -->
        </div>

    </div>
@endsection
@section('js')

<script src="js/session.js"></script>
@endsection

<!--
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
-->