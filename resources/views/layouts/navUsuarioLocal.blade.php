@extends('layouts.template')
<!-- CSS -->
@section('css')
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
@yield('css2')
@endsection
<!-- fin -->
@section('contenido')
<!-- Inicio navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="home">BarDotCom</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); 
                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
            </li>
        </ul>
            <!-- Inicio menú de usuario -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a id="navbarDropdown" class="nav-link" href="{{ route('dashUsuarioLocalperfil') }}" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->nombre }} <span class="caret"></span></a>
            </li>
        </ul>
        <!-- Fin menú de usuario -->
    </div>
</nav>
<!-- Fin navbar -->
<!-- Inicio sidebar -->
<div class="area"></div>
<nav class="main-menu">
    <ul>
        <li>
            <a href="{{ route('dashUsuarioLocal') }}">
                <i class="fa fa-home fa-2x"></i>
                <span class="nav-text">Inicio</span>
            </a>
        </li>
        <li>
            <a href="{{ route('pedidosEntregados') }}">
                <i class="fa fa-laptop fa-2x"></i>
                <span class="nav-text">Pedidos entregados</span>
            </a>
        </li>
        <li class="has-subnav">
            <a href="{{ route('cuentasEntregadas') }}">
                <i class="fa fa-bar-chart-o fa-2x"></i>
                <span class="nav-text">Cuentas entregadas</span>
            </a>
        </li>
    </ul>
</nav>
<!-- Fin sidebar -->
@yield('contenidodash')
@endsection
<!-- JS -->
@section('js')
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
@yield('js2')
@endsection
<!-- Fin JS -->