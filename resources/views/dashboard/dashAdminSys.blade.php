@extends('layouts.navAdminSys')
<!-- Título -->
@section('titulo')
Panel de administración
@endsection
@section('contenidodash')
    <div class="container cuerpo">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <a href="{{ route('dashAdminSyslocalesCrear') }}" class="btn btn-primary btn-block">Nuevo local comercial</a>
            </div>
        </div>
    </div>
@endsection