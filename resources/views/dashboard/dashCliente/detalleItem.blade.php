@extends('layouts.navCliente')
<!-- Título -->
@section('titulo')
Detalle ítem
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
        <form action="{{ route('hacerPedido') }}" method="POST">
        @csrf
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-sm-4">
                                <img src="{{ asset('images/local'.$data['item']->idLocal.'/item/'.$data['item']->imagen) }}" class="card-img" alt="">
                            </div>
                            <div class="col-sm-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{$data['item']->nombre}}</h5>
                                    <p class="card-text">Valor: {{$data['item']->precio}}</p>
                                    <p class="card-text">Descripción: {{$data['item']->descripcion}}</p>
                                    <input type="hidden" name="idItem" id="idItem" value="{{$data['item']->id}}">
                                    <input type="hidden" name="idLocal" id="idLocal" value="{{$data['item']->idLocal}}">
                                    <div class="form-group">
                                        <label for="cantidad">Cantidad</label>
                                        <select name="cantidad" id="cantidad" class="custom-select" required>
                                            <option value="1" selected>1</option>
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
                </div>
                <div class="col-md-6 offset-md-3">
                    @if ($data['respuesta'] == 2)
                        <button disabled class="btn btn-success btn-block disabled">Solicitar</button>
                    @endif
                    @if ($data['respuesta'] == 3)
                        <button type="submit" class="btn btn-success btn-block">Solicitar</button>
                    @endif
                    <br>
                    <a href="{{ route('dashCliente') }}" class="btn btn-secondary btn-block">Volver</a>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js2')
<script>var respuesta = {{{$data['respuesta']}}}</script>
<script src="{{ asset('js/detalleItem.js') }}"></script>
@endsection