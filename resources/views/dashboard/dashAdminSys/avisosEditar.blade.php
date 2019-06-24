@extends('layouts.navAdminSys')
<!-- Título -->
@section('titulo')
Editar avisos
@endsection
@section('contenidodash')
    <div class="container cuerpo">
        <h3 class="text-center">Reenviar aviso global</h3>
        <h5 class="text-center">Complete el siguiente formulario para reenviar el aviso global</h5>
        <form action="{{ route('editAviso') }}" method="POST" enctype="multipart/form-data">
            @csrf
        <input type="hidden" name="id" id="id" value="{{$data['avisos']->id}}">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="nombre">Título</label>
                        </div>
                        <div class="col-md-9">
                        <input type="text" name="nombre" id="nombre" class="form-control" required value="{{$data['avisos']->nombre}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="descripcion">Descripción</label>
                        </div>
                        <div class="col-md-9">
                        <textarea name="descripcion" id="descripcion" rows="3" class="form-control" required>{{$data['avisos']->descripcion}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2 offset-md-4">
                    <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('dashAdminSysavisos') }}" name="btnCancelar" id="btnCancelar" class="btn btn-info btn-block">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js2')
<script>var respuesta = {{{$data['respuesta']}}}</script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/AdminSysAvisosCRUD.js') }}"></script>
@endsection