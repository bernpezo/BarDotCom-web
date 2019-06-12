@extends('layouts.navAdminSys')
<!-- Título -->
@section('titulo')
Panel de administración
@endsection
@section('contenidodash')
    <div class="container cuerpo">
        <div class="row">
            <div class="col-md-6">
                <h3 class="text-center">Avisos</h3>

            </div>
            <div class="col-md-6">
                <h3 class="text-center">Cifras</h3>
                <div>
                    <h5>Total de usuarios:</h5>
                    <h5>Total de locales:</h5>
                    
                </div>
            </div>
        </div>
    </div>
@endsection