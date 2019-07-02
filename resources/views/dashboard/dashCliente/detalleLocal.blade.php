@extends('layouts.navCliente')
<!-- Título -->
@section('titulo')
Detalle local
@endsection
@section('contenidodash')
    <div class="container cuerpo">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-sm-4">
                            <img src="{{ asset('images/local'.$data->id.'/'.$data->logo) }}" class="card-img" alt="">
                        </div>
                        <div class="col-sm-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$data->nombre}}</h5>
                                <p class="card-text">email: {{$data->email}}</p>
                                <p class="card-text">Dirección: {{$data->direccion}}</p>
                                <p class="card-text">Contacto: {{$data->telefono}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 offset-md-3">
                <a href="{{ route('revisarCarta', ['id'=>$data->id]) }}" class="btn btn-success btn-block">Revisar carta</a>
                <br>
                <a href="{{ route('dashCliente') }}" class="btn btn-secondary btn-block">Volver</a>
            </div>
        </div>
    </div>
@endsection