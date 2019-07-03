@extends('layouts.navCliente')
@section('css2')
<script type="text/javascript">
    function revisarCliente() {
        try {
            Android.revisarCliente();
        } catch (error) {
            $("#vistaHTML").removeClass('d-none');
            $("#vistaAndroid").addClass('d-none');
        }
    }
    window.onload = revisarCliente;
    </script>
@endsection
<!-- Título -->
@section('titulo')
Revisar carta
@endsection
@section('contenidodash')
    <div class="container cuerpo d-none" id="vistaHTML">
        <h4 class="text-center">Bienvenido a <strong>BarDotCom</strong></h4>
        <div class="row justify-content-center">
            <img src="{{ asset('images/home/google.png') }}" alt="">
        </div>
        <h5 class="text-center">¡Descarga la aplicación!</h5>
    </div>
    <div class="container cuerpo" id="vistaAndroid">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <a href="{{ route('dashCliente') }}" class="btn btn-secondary btn-block">Volver</a>
            </div>
            <div class="col-md-6 offset-md-3">
                @foreach($data as $item)
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-sm-4">
                                <a href="{{ route('detalleItem', ['id'=>$item->id]) }}">
                                    <img src="{{ asset('images/local'.$item->idLocal.'/item/'.$item->imagen) }}" class="card-img" alt="">
                                </a>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{$item->nombre}}</h5>
                                    <p class="card-text">Valor: ${{$item->precio}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection