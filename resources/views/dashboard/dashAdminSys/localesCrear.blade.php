@extends('layouts.navAdminSys')
@section('css2')
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection
<!-- Título -->
@section('titulo')
Crear local comercial
@endsection
@section('contenidodash')
    <div class="container cuerpo">
        <h3 class="text-center">Crear local comercial</h3>
        <h5 class="text-center">Complete el siguiente formulario para crear un nuevo local comercial</h5>
        <form action="{{ route('createLocalComercial') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4 offset-md-2">
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
                            <label for="direccion">Dirección</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="direccion" id="direccion" class="form-control" required>
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
                            <label for="rubro">Rubro</label>
                        </div>
                        <div class="col-md-9">
                            <select class="js-data-example-ajax form-control" name="rubro" id="rubro" data-url="{{ route('selectRubro') }}" required></select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="logo">Logo</label>
                        </div>
                        <div class="col-md-9">
                            <input type="file" name="logo" id="logo" class="form-control-file" required>
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
                            <label for="descripcion">Descripción</label>
                        </div>
                        <div class="col-md-9">
                            <textarea name="descripcion" id="descripcion" rows="3" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2 offset-md-4">
                    <button type="submit" class="btn btn-success btn-block">Ingresar</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('dashAdminSys') }}" name="btnCancelar" id="btnCancelar" class="btn btn-secondary btn-block">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js2')
<script>var respuesta = {{{$respuesta}}}</script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/AdminSyslocalCRUD.js') }}"></script>
@endsection