@extends('layouts.navUsuarioLocal')
@section('css2')
@endsection
<!-- Título -->
@section('titulo')
Registrar cliente
@endsection
@section('contenidodash')
    <div class="container cuerpo">
        <h3 class="text-center">Registrar cliente</h3>
        <div>
            <form action="{{ route('registrarNFC') }}" method="POST">
                @csrf
                <div class="col-md-6 offset-md-3">
                    <div class="form-group">
                        <label for="nfc">Tarjeta NFC</label>
                        <input type="number" name="nfc" id="nfc" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="mesa">Mesa N°</label>
                        <input type="number" name="mesa" id="mesa" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block">Registrar</button>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('dashUsuarioLocal') }}" class="btn btn-secondary btn-block">Volver</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js2')
<script>var respuesta = {{{$respuesta}}}</script>
<script src="{{ asset('js/registrarCliente.js') }}"></script>
@endsection