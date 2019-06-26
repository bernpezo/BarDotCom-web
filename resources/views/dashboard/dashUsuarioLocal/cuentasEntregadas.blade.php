@extends('layouts.navUsuarioLocal')
@section('css2')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
@endsection
<!-- Título -->
@section('titulo')
Cuentas entregadas
@endsection
@section('contenidodash')
    <div class="container cuerpo">
        <h3>Cuentas entregadas</h3>
        <form action="" method="POST">
            @csrf
            <div>
                <table class="display responsive nowrap" style="width:100%" id="tablaCuentasEntregadas" data-url="{{ route('showCuentasEntregadas') }}">
                    <thead>
                        <tr>
                            <th scope="col">Cliente</th>
                            <th scope="col">Mesa</th>
                            <th scope="col">Total</th>
                            <th scope="col">Pedida en</th>
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
<script src="{{ asset('js/UsuarioLocalCuentas.js') }}"></script>
@endsection