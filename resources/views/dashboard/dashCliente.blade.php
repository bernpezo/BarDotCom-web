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
Buscar local
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
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('dashCliente') }}">Buscar locales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('verCuenta') }}" style="color: black;">Pedir cuenta</a>
            </li>
        </ul>
        <br>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                @foreach($data as $locales)
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-sm-4">
                                <a href="{{ route('detalleLocal', ['id'=>$locales->id]) }}">
                                    <img src="{{ asset('images/local'.$locales->id.'/'.$locales->logo) }}" class="card-img" alt="">
                                </a>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{$locales->nombre}}</h5>
                                    <p class="card-text">{{$locales->direccion}}</p>
                                    <p class="card-text">Contacto: {{$locales->telefono}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection