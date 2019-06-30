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
                    <a href="{{ route('promocionesCrear') }}" class="btn btn-success btn-block from-control">Crear promoción</a>
                </div>
                <div class="form-group">
                    <a href="{{ route('mesasCrear') }}" class="btn btn-success btn-block from-control">Crear mesa local</a>
                </div>
                <div class="form-group">
                    <a href="{{ route('itemsCrear') }}" class="btn btn-success btn-block from-control">Crear ítem</a>
                </div>
            </div>
        </div>
    </div>
@endsection