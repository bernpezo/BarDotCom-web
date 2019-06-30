@extends('layouts.navAdminSys')
<!-- Título -->
@section('titulo')
Crear avisos
@endsection
@section('contenidodash')
    <div class="container cuerpo">
        <h3 class="text-center">Crear aviso global</h3>
        <h5 class="text-center">Complete el siguiente formulario para crear un aviso global</h5>
        <form action="{{ route('createAviso') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="nombre">Título</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
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
<script src="{{ asset('js/AdminSysAvisosCRUD.js') }}"></script>
@endsection