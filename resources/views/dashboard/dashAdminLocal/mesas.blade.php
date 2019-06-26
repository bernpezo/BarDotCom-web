@extends('layouts.navAdminLocal')
@section('css2')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
@endsection
<!-- Título -->
@section('titulo')
Mesas
@endsection
@section('contenidodash')
<div class="container cuerpo">
    <h3>Mesas registradas</h3>
        <form action="" method="POST">
            @csrf
            <div>
                <table class="display responsive nowrap" style="width:100%" id="tablaMesas" data-url="{{ route('showMesa') }}">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">numero</th>
                            <th scope="col">Fecha</th>
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
<script src="{{ asset('js/AdminLocalMesas.js') }}"></script>
@endsection