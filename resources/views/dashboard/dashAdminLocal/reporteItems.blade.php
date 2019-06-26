@extends('layouts.navAdminLocal')
@section('css2')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
@endsection
<!-- Título -->
@section('titulo')
Reporte items
@endsection
@section('contenidodash')
<div class="container cuerpo">
    <h3>Reporte items</h3>
    <form action="" method="POST">
        @csrf
        <div>
            <table class="display responsive nowrap" style="width:100%" id="tablaReporteItems" data-url="{{ route('showReporteItem') }}">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Stock</th>
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
<script src="{{ asset('js/reporteItem.js') }}"></script>
@endsection