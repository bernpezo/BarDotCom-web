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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
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
                <a id="navbarDropdown" class="nav-link" href="{{ route('dashClienteperfil') }}" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->nombre }} <span class="caret"></span></a>
            </li>
        </ul>
        <!-- Fin menú de usuario -->
    </div>
</nav>
<!-- Fin navbar -->
@yield('contenidodash')
@endsection
<!-- JS -->
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
@section('js')
@yield('js2')
@endsection
<!-- Fin JS -->