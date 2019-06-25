@extends('layouts.navAdminLocal')
<!-- Título -->
@section('titulo')
Panel de administración
@endsection
@section('contenidodash')
    <div class="container cuerpo">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="form-group">
                    <a href="{{ route('promocionesCrear') }}" class="btn btn-primary btn-block from-control">Crear promoción</a>
                </div>
                <div class="form-group">
                    <a href="#" class="btn btn-primary btn-block from-control">Boton 2</a>
                </div>
            </div>
        </div>
    </div>
@endsection