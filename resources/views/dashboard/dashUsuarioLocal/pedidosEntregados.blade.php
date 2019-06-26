@extends('layouts.navUsuarioLocal')
@section('css2')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
@endsection
<!-- Título -->
@section('titulo')
Pedidos entregados
@endsection
@section('contenidodash')
    <div class="container cuerpo">
        <h3>Pedidos entregados</h3>
        <form action="" method="POST">
            @csrf
            <div>
                <table class="display responsive nowrap" style="width:100%" id="tablaPedidosEntregados" data-url="{{ route('showPedidosEntregados') }}">
                    <thead>
                        <tr>
                            <th scope="col">Cliente</th>
                            <th scope="col">Mesa</th>
                            <th scope="col">Item</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Pedido en</th>
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
<script src="{{ asset('js/UsuarioLocalPedidos.js') }}"></script>
@endsection