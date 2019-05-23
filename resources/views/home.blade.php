@extends('layouts.template')
@section('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection
@section('contenido')
    <!-- Inicio navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="#">BarDotCom</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Características</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Ingresar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Fin navbar -->
    <div class="container">
        <!-- Inicio carrousel -->

        <!-- Fin carrousel -->
        <!-- Inicio características -->

        <!-- Fin características -->
        <!-- Inicio FAQ -->

        <!-- Fin FAQ -->
        <!-- Inicio Contacto -->

        <!-- Fin contacto -->
        
    </div>
@endsection