@extends('layouts.navAdminLocal')
@section('css2')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
@endsection
<!-- Título -->
@section('titulo')
Reporte semanal
@endsection
@section('contenidodash')
<div class="container cuerpo">
    <h3>Reporte semanal</h3>
    <form action="" method="POST">
        @csrf
        <div>
            <table class="display responsive nowrap" style="width:100%" id="tablaReporteSemanal" data-url="{{ route('showReporteSemanal') }}">
                <thead>
                    <tr>
                        <th scope="col">Cliente</th>
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
<script src="{{ asset('js/reporteSemanal.js') }}"></script>
@endsection