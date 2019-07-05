@extends('layouts.template')
@section('contenido')
<div class="container">
    <div style="margin-top: 20px;">
        <h3 class="text-center text-danger">¡Error!</h3>
        <br><br>
        <h5 class="text-center">Contacte al administrador</h5>
        <br><br>
        <p>{{$th}}</p>
        <br><br>
        <a href="{{ route('home') }}" class="btn btn-secondary">Volver al home</a>
    </div>
</div>

@endsection