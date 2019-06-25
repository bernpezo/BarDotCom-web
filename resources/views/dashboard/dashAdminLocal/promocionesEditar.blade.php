@extends('layouts.navAdminLocal')
<!-- Título -->
@section('titulo')
Editar promociones
@endsection
@section('contenidodash')
    <div class="container cuerpo">
        <h3 class="text-center">Editar promoción</h3>
        <h5 class="text-center">Complete el siguiente formulario para editar la promoción</h5>
        <form action="{{ route('editPromocion') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="id" value="{{$data['promocion']->id}}">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="nombre">Título</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="nombre" id="nombre" class="form-control" required value="{{$data['promocion']->nombre}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="imagen">Imagen</label>
                        </div>
                        <div class="col-md-9">
                            <input type="file" name="imagen" id="imagen" class="form-control-file" required value="{{$data['promocion']->imagen}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="descripcion">Descripción</label>
                        </div>
                        <div class="col-md-9">
                            <textarea name="descripcion" id="descripcion" rows="3" class="form-control" required>{{$data['promocion']->descripcion}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2 offset-md-4">
                    <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('dashAdminLocalPromociones') }}" name="btnCancelar" id="btnCancelar" class="btn btn-info btn-block">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js2')
<script>var respuesta = {{{$data['respuesta']}}}</script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/AdminLocalPromocionesCRUD.js') }}"></script>
@endsection