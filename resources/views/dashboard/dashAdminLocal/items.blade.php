@extends('layouts.navAdminLocal')
@section('css2')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
@endsection
<!-- Título -->
@section('titulo')
Ítems
@endsection
@section('contenidodash')
<div class="container cuerpo">
    <h3>Ítems registrados</h3>
        <form action="" method="POST">
            @csrf
            <div>
                <table class="table table-striped" id="tablaItems" data-url="{{ route('showItem') }}">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Stock</th>
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
<script src="{{ asset('js/AdminLocalItems.js') }}"></script>
@endsection