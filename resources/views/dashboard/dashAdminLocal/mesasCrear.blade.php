@extends('layouts.navAdminLocal')
<!-- Título -->
@section('titulo')
Crear Mesas
@endsection
@section('contenidodash')
    <div class="container cuerpo">
        <h3 class="text-center">Crear nueva mesa</h3>
        <form action="{{ route('createMesa') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="numero">Número</label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" name="numero" id="numero" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2 offset-md-4">
                    <button type="submit" class="btn btn-success btn-block">Ingresar</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('dashAdminLocal') }}" name="btnCancelar" id="btnCancelar" class="btn btn-secondary btn-block">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js2')
<script>var respuesta = {{{$respuesta}}}</script>
<script src="{{ asset('js/AdminLocalMesasCRUD.js') }}"></script>
@endsection