@extends('layouts.navAdminSys')
@section('css2')
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection
<!-- Título -->
@section('titulo')
Perfil de usuario
@endsection
@section('contenidodash')
    <div class="container cuerpo">
        perfil de usuario
    </div>
@endsection
@section('js2')
<script src="{{ asset('js/select2.min.css') }}"></script>
<script src="{{ asset('js/session.js') }}"></script>
@endsection