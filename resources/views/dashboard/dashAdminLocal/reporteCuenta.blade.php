@extends('layouts.navAdminLocal')
@section('css2')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
@endsection
<!-- Título -->
@section('titulo')
Reporte cuenta
@endsection
@section('contenidodash')
<div class="container cuerpo">
    <h3>Reporte cuenta</h3>
    <form action="" method="POST">
        @csrf
        <div>
            <table class="display responsive nowrap" style="width:100%" id="tablaReporteCuenta" data-url="{{ route('showReporteCuenta') }}">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Mesa</th>
                        <th scope="col">Total</th>
                        <th scope="col">Fecha</th>
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
<script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/reporteCuenta.js') }}"></script>
@endsection