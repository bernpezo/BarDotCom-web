@extends('layouts.navAdminLocal')
<!-- Título -->
@section('titulo')
Crear Promociones
@endsection
@section('contenidodash')
    <div class="container cuerpo">
        <h3 class="text-center">Crear nueva promoción</h3>
        <form action="#" method="POST" enctype="multipart/form-data">
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
                            <label for="imagen">Imagen</label>
                        </div>
                        <div class="col-md-9">
                            <input type="file" name="imagen" id="imagen" class="form-control-file" required>
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
                    <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('dashAdminLocal') }}" name="btnCancelar" id="btnCancelar" class="btn btn-info btn-block">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js2')
<script>var respuesta = {{{$respuesta}}}</script>
<script src="{{ asset('js/AdminSysAvisosCRUD.js') }}"></script>
@endsection