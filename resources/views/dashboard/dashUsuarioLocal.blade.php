@extends('layouts.navUsuarioLocal')
@section('css2')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
@endsection
<!-- Título -->
@section('titulo')
Panel de administración
@endsection
@section('contenidodash')
    <div class="container cuerpo">
        <h3>Pedidos pendientes</h3>
        <div class="d-lg-none">
            <br>
            <a href="{{ route('registrarCliente') }}" class="btn btn-success btn-block">Registrar cliente</a>
            <br>
        </div>
        <form action="" method="POST">
            @csrf
            <div>
                <table class="display responsive nowrap" style="width:100%" id="tablaPedidos" data-url="{{ route('showPedidosPendientes') }}">
                    <thead>
                        <tr>
                            <th class="d-none d-lg-block" scope="col">Cliente</th>
                            <th scope="col">Mesa</th>
                            <th scope="col">Item</th>
                            <th scope="col">Cantidad</th>
                            <th class="d-none d-lg-block" scope="col">Pedido en</th>
                            <th class="d-none d-lg-block" scope="col">Entregar / Eliminar</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>    
            </div>  
        </form>
        <h3>Cuentas pendientes</h3>
        <form action="" method="POST">
            @csrf
            <div>
                <table class="display responsive nowrap" style="width:100%" id="tablaCuentas" data-url="{{ route('showCuentasPendientes') }}">
                    <thead>
                        <tr>
                            <th class="d-none d-lg-block" scope="col">Cliente</th>
                            <th scope="col">Mesa</th>
                            <th scope="col">Total</th>
                            <th class="d-none d-lg-block" scope="col">Pedida en</th>
                            <th class="d-none d-lg-block"scope="col">Editar / Eliminar</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>    
            </div>  
        </form>
    </div>
@endsection
@section('js2')
<script>var respuesta = {{{$respuesta}}}</script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dashUsuarioLocal.js') }}"></script>
@endsection