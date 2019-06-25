@extends('layouts.navAdminLocal')
<!-- Título -->
@section('titulo')
Crear Ítem
@endsection
@section('contenidodash')
    <div class="container cuerpo">
        <h3 class="text-center">Crear nuevo ítem</h3>
        <form action="{{ route('createItem') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="nombre">Nombre</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="imagen">Imagen</label>
                        </div>
                        <div class="col-md-9">
                            <input type="file" name="imagen" id="imagen" class="form-control-file" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="precio">Precio</label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" name="precio" id="precio" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="estado">Estado</label>
                        </div>
                        <div class="col-md-9">
                            <select name="estado" id="estado" class="custom-select">
                                <option value="1">Disponible</option>
                                <option value="0">No disponible</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="stock">Stock</label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" name="stock" id="stock" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="descripcion">Descripción</label>
                        </div>
                        <div class="col-md-9">
                            <textarea name="descripcion" id="descripcion" rows="3" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2 offset-md-4">
                    <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('dashAdminLocal') }}" name="btnCancelar" id="btnCancelar" class="btn btn-info btn-block">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js2')
<script>var respuesta = {{{$respuesta}}}</script>
<script src="{{ asset('js/AdminLocaItemsCRUD.js') }}"></script>
@endsection