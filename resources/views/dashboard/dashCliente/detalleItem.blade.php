@extends('layouts.navCliente')
<!-- Título -->
@section('titulo')
Detalle ítem
@endsection
@section('contenidodash')
    <div class="container cuerpo">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-sm-4">
                            <img src="{{ asset('images/local'.$data->id.'/item/'.$data->imagen) }}" class="card-img" alt="">
                        </div>
                        <div class="col-sm-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$data->nombre}}</h5>
                                <p class="card-text">Valor: {{$data->precio}}</p>
                                <p class="card-text">Descripción: {{$data->descripcion}}</p>
                                <form action="{{ route('hacerPedido') }}" method="POST">
                                    @csrf
                                    <select name="cantidad" id="cantidad" class="custom-select">
                                        <option value="0" selected>Cantidad</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 offset-md-3">
                <a href="{{ route('hacerPedido', ['id'=>$data->id]) }}" class="btn btn-success btn-block">Solicitar</a>
                <br>
                <a href="{{ route('dashCliente') }}" class="btn btn-secondary btn-block">Volver</a>
            </div>
        </div></form>
    </div>
@endsection