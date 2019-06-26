@extends('layouts.navCliente')
@section('css2')
<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.css') }}">
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection
<!-- Título -->
@section('titulo')
Perfil de usuario
@endsection
@section('contenidodash')
    <div class="container cuerpo">
        <h3 class="text-center">Modificar Perfil</h3>
        <h5 class="text-center">Modifique su perfil</h5>
        <form action="{{ route('ClienteeditPerfil') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="id" value="{{$data['user']->id}}">
            <div class="row">
                <div class="col-md-4 offset-md-2">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="nombre">Nombre</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="nombre" id="nombre" class="form-control" required value="{{$data['user']->nombre}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="apellido">Apellido</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="apellido" id="apellido" class="form-control" required value="{{$data['user']->apellido}}">
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
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="fechaNacimiento">Fecha de nacimiento</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="fechaNacimiento" id="fechaNacimiento" class="form-control" required value="{{$data['user']->fechaNacimiento}}"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-md-9">
                            <input type="email" name="email" id="email" class="form-control" required value="{{$data['user']->email}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="telefono">Teléfono</label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" name="telefono" id="telefono" class="form-control" required value="{{$data['user']->telefono}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="password">Contraseña nueva</label>
                        </div>
                        <div class="col-md-9">
                            <input type="password" name="password" id="password" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="passwordActual">Contraseña actual</label>
                        </div>
                        <div class="col-md-9">
                            <input type="password" name="passwordActual" id="passwordActual" class="form-control" required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2 offset-md-4">
                    <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('dashCliente') }}" name="btnCancelar" id="btnCancelar" class="btn btn-info btn-block">Cancelar</a>
                </div>
            </div>
        </form>
        <form action="{{ route('ClienteeliminarCuenta') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="id" value="{{$data['user']->id}}">
            <h5 class="text-center">Eliminar cuenta</h5>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="passwordEliminar">Contraseña</label>
                        </div>
                        <div class="col-md-9">
                            <input type="password" name="passwordEliminar" id="passwordEliminar" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-block">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js2')
<script>var respuesta = {{{$data['respuesta']}}}</script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}" charset="UTF-8"></script>
<script src="{{ asset('js/bootstrap-datepicker.es.js') }}"></script>
<script src="{{ asset('js/session.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/perfil.js') }}"></script>
@endsection