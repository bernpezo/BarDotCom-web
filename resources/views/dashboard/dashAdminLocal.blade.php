@extends('layouts.navAdminLocal')
<!-- Título -->
@section('titulo')
Panel de administración
@endsection
@section('contenidodash')
    <div class="container cuerpo">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="form-group">
                    <a href="{{ route('promocionesCrear') }}" class="btn btn-success btn-block from-control">Crear promoción</a>
                </div>
                <div class="form-group">
                    <a href="{{ route('mesasCrear') }}" class="btn btn-success btn-block from-control">Crear mesa local</a>
                </div>
                <div class="form-group">
                    <a href="{{ route('itemsCrear') }}" class="btn btn-success btn-block from-control">Crear ítem</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h5>Avisos de sistema</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $d)
                            <tr>
                                <td>{{ $d->nombre }}</td>
                                <td>{{ $d->descripcion }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection