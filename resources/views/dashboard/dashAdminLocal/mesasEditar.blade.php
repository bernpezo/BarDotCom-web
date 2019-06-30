@extends('layouts.navAdminLocal')
<!-- Título -->
@section('titulo')
Editar mesas
@endsection
@section('contenidodash')
    <div class="container cuerpo">
        <h3 class="text-center">Editar mesa</h3>
        <h5 class="text-center">Complete el siguiente formulario para editar la mesa</h5>
        <form action="{{ route('editMesa') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="id" value="{{$data['mesa']->id}}">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="numero">Número</label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" name="numero" id="numero" class="form-control" required value="{{$data['mesa']->numero}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2 offset-md-4">
                    <button type="submit" class="btn btn-success btn-block">Ingresar</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('dashAdminLocalMesas') }}" name="btnCancelar" id="btnCancelar" class="btn btn-secondary btn-block">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js2')
<script>var respuesta = {{{$data['respuesta']}}}</script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/AdminLocalMesasCRUD.js') }}"></script>
@endsection