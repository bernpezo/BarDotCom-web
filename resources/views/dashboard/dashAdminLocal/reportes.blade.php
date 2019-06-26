@extends('layouts.navAdminLocal')
<!-- Título -->
@section('titulo')
Reportes
@endsection
@section('contenidodash')
    <div class="container cuerpo">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="form-group">
                    <a href="{{ route('reporteItems') }}" class="btn btn-primary btn-block from-control">Generar reporte items</a>
                </div>
                <div class="form-group">
                    <a href="{{ route('reporteSemanal') }}" class="btn btn-primary btn-block from-control">Generar reporte semanal</a>
                </div>
                <div class="form-group">
                    <a href="{{ route('reporteMensual') }}" class="btn btn-primary btn-block from-control">Generar reporte mensual</a>
                </div>
                <div class="form-group">
                    <a href="{{ route('reporteCuenta') }}" class="btn btn-primary btn-block from-control">Generar reporte cuenta</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js2')
@endsection