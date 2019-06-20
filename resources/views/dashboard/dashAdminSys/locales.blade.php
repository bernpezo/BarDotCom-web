@extends('layouts.navAdminSys')
@section('css2')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
@endsection
<!-- Título -->
@section('titulo')
Locales comerciales
@endsection
@section('contenidodash')
    <div class="container cuerpo">
        <h3>Locales comerciales registrados</h3>
        <form action="" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group margen-control">
                        <input type="text" name="buscar" id="buscar" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary btn-block">Buscar</button>
                </div>
            </div>  
        </form>
    </div>
@endsection
@section('js2')
<script src="{{ asset('js/AdminSyslocales.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
@endsection