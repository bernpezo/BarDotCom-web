@extends('layouts.navAdminLocal')
<!-- Título -->
@section('titulo')
Editar Ítems
@endsection
@section('contenidodash')
    <div class="container cuerpo">
        <h3 class="text-center">Editar ítem</h3>
        <h5 class="text-center">Complete el siguiente formulario para editar el ítem</h5>
        <form action="{{ route('editItem') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="id" value="{{$data['item']->id}}">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="nombre">Nombre</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="nombre" id="nombre" class="form-control" required value="{{$data['item']->nombre}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="imagen">Imagen</label>
                        </div>
                        <div class="col-md-9">
                            <input type="file" name="imagen" id="imagen" class="form-control-file" required value="{{$data['item']->imagen}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="precio">Precio</label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" name="precio" id="precio" class="form-control" required value="{{$data['item']->precio}}">
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
                            <input type="number" name="stock" id="stock" class="form-control" required value="{{$data['item']->stock}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="descripcion">Descripción</label>
                        </div>
                        <div class="col-md-9">
                            <textarea name="descripcion" id="descripcion" rows="3" class="form-control" require>{{$data['item']->descripcion}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2 offset-md-4">
                    <button type="submit" class="btn btn-success btn-block">Ingresar</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('dashAdminLocalItems') }}" name="btnCancelar" id="btnCancelar" class="btn btn-secondary btn-block">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js2')
<script>var respuesta = {{{$data['respuesta']}}}</script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/AdminLocalMesasCRUD.js') }}"></script>
@endsection