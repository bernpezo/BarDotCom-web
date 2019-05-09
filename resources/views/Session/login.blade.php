@extends('layouts.template')
<!-- CSS de Session -->
@section('css')
    <link rel="stylesheet" href="{{ asset('css/session.css') }}">
@endsection
<!-- Fin CSS -->
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div>
                    <!-- Inicio formulario de Log-in -->
                    <form action="" method="POST">
                        <h1 class="text-centered">Bienvenido</h1>

                    </form>
                    <!-- Fin formulario de Log-in -->
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection