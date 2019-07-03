@extends('layouts.navCliente')
<!-- Título -->
@section('titulo')
Detalle local
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
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-sm-4">
                            <img src="{{ asset('images/local'.$data['local']->id.'/'.$data['local']->logo) }}" class="card-img" alt="">
                        </div>
                        <div class="col-sm-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$data['local']->nombre}}</h5>
                                <p class="card-text">email: {{$data['local']->email}}</p>
                                <p class="card-text">Dirección: {{$data['local']->direccion}}</p>
                                <p class="card-text">Contacto: {{$data['local']->telefono}}</p>
                                <p class="card-text">Descripción: {{$data['local']->descripcion}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 offset-md-3">
                <a href="{{ route('revisarCarta', ['id'=>$data['local']->id]) }}" class="btn btn-success btn-block">Revisar carta</a>
                <br>
                <a href="{{ route('dashCliente') }}" class="btn btn-secondary btn-block">Volver</a>
            </div>
            <br>
            <div class="col-md-6 offset-md-3">
                <h5>Promociones</h5>
                @foreach($data['promocion'] as $promocion)
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-sm-4">
                                <img src="{{ asset('images/local'.$promocion->id.'/promocion/'.$promocion->imagen) }}" class="card-img" alt="">
                            </div>
                            <div class="col-sm-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{$promocion->nombre}}</h5>
                                    <p class="card-text">{{$promocion->descripcion}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection