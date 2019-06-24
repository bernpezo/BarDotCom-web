@extends('layouts.navAdminSys')
@section('css2')
<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.css') }}">
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection
<!-- Título -->
@section('titulo')
Crear administrador local
@endsection
@section('contenidodash')
    <div class="container cuerpo">
        <h3 class="text-center">Crear administrador de local</h3>
        <h5 class="text-center">Complete el siguiente formulario para crear un nuevo administrador de local</h5>
        <form action="{{ route('createAdministrador_local') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4 offset-md-2">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="local">Local comercial</label>
                        </div>
                        <div class="col-md-9">
                            <select class="js-data-example-ajax form-control" name="local" id="local" data-url="{{ route('selectLocal') }}" required></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="rut">RUT</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="rut" id="rut" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="nombre">Nombre</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="apellido">Apellido</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="apellido" id="apellido" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="comuna">Comuna</label>
                        </div>
                        <div class="col-md-9">
                            <select class="js-data-example-ajax form-control" name="comuna" id="comuna" data-url="{{ route('selectComuna') }}" required></select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="fechaNacimiento">Fecha de nacimiento</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="fechaNacimiento" id="fechaNacimiento" class="form-control" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-md-9">
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="telefono">Teléfono</label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" name="telefono" id="telefono" class="form-control"required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="password">Contraseña</label>
                        </div>
                        <div class="col-md-9">
                            <input type="password" name="password" id="password" class="form-control" required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2 offset-md-4">
                    <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('dashAdminSys') }}" name="btnCancelar" id="btnCancelar" class="btn btn-info btn-block">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js2')
<script>var respuesta = {{{$respuesta}}}</script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}" charset="UTF-8"></script>
<script src="{{ asset('js/bootstrap-datepicker.es.js') }}"></script>
<script src="{{ asset('js/session.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/AdminSyslocalCRUD.js') }}"></script>
@endsection