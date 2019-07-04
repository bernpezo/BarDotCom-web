@extends('layouts.navCliente')
<!-- Título -->
@section('titulo')
Pedir cuenta
@endsection
@section('contenidodash')
    <div class="container cuerpo d-none d-lg-block">
        <h4 class="text-center">Bienvenido a <strong>BarDotCom</strong></h4>
        <div class="row justify-content-center">
            <img src="{{ asset('images/home/google.png') }}" alt="">
        </div>
        <h5 class="text-center">¡Descarga la aplicación!</h5>
    </div>
    <div class="container cuerpo d-lg-none">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashCliente') }}" style="color: black;">Buscar locales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('verCuenta') }}" style="color: black;">Pedir cuenta</a>
            </li>
        </ul>
        <br>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h5>Pedidos</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Listo</th>
                            <th scope="col">Cant.</th>
                            <th scope="col">Detalle</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['pedido'] as $pedido)
                            <tr>
                                @if ($pedido->estado == 2)
                                    <td>No</td>
                                @endif
                                @if ($pedido->estado == 1)
                                    <td>Si</td>
                                @endif
                                <td>{{ $pedido->cantidadItem }}</td>
                                @foreach ($data['itemPedido'] as $item)
                                @if ($pedido->idItem == $item->id)
                                    <td>{{ $item->nombre }}</td>
                                    <td>${{ $item->precio * $pedido->cantidadItem }}</td>
                                @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <span>* Solo los pedidos listos se suman a tu cuenta</span>
            </div>
            <div class="col-md-8 offset-md-2">
                <br>
                @if ($data['cuenta']->total==0 || $data['cuenta']->estado==1)
                    <h6>Total: $0</h6>
                    <br>
                    <a href="{{ route('pedirCuenta', ['id'=>$data['cuenta']->id]) }}" class="btn btn-success btn-block disabled">Pedir cuenta</a>
                @else
                    <h6>Total: ${{$data['cuenta']->total}}</h6>
                    <br>
                    <a href="{{ route('pedirCuenta', ['id'=>$data['cuenta']->id]) }}" class="btn btn-success btn-block">Pedir cuenta</a>
                @endif
                <br>
            </div>
        </div>
    </div>
@endsection
@section('js2')
<script>var respuesta = {{{$data['respuesta']}}}</script>
<script src="{{ asset('js/verCuenta.js') }}"></script>
@endsection