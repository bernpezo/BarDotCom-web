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
            <div>
                <table class="table table-striped" id="tablaLocales" data-url="{{ route('showLocalComercial') }}">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Editar / Eliminar</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>    
            </div>  
        </form>
    </div>
@endsection
@section('js2')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/AdminSyslocales.js') }}"></script>
@endsection