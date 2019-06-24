@extends('layouts.navAdminSys')
<!-- Título -->
@section('titulo')
Panel de administración
@endsection
@section('contenidodash')
    <div class="container cuerpo">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="form-group">
                    <a href="{{ route('dashAdminSyslocalesCrear') }}" class="btn btn-primary btn-block from-control">Nuevo local comercial</a>
                </div>
                <div class="form-group">
                    <a href="{{ route('dashAdminSysadministradoresCrear') }}" class="btn btn-primary btn-block from-control">Nuevo administrador de local</a>
                </div>
                <div class="form-group">
                    <a href="{{ route('dashAdminSysavisosCrear') }}" class="btn btn-primary btn-block from-control">Nuevo Aviso de sistema</a>
                </div>
            </div>
        </div>
    </div>
@endsection