@extends('layouts.template')
<!-- CSS de session -->
@section('css')
    <link rel="stylesheet" href="{{ asset('css/session.css') }}">
@endsection
<!-- Fin CSS -->
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h1>Bienvenido</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore illum rem neque aspernatur quibusdam eveniet aliquid quidem. Perferendis officiis tempora, expedita dolor, quia laboriosam quod asperiores ex at alias adipisci?</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis dolorem similique non, asperiores pariatur officiis ab quaerat nam deleniti, dolore facere repudiandae magni laborum dolor laboriosam? Iure doloribus consectetur possimus.</p>
            </div>
            <!-- Inicio formulario de registro -->
            <form action="" method="POST">
                <div class="col-md-4 form-group">
                    <h3>Sobre tí</h3>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre" class="form-control">
                    <input type="text" name="apellido" id="apellido" placeholder="Apellido" class="form-control">
                    <select name="comuna" id="comuna" class="form-control"></select>
                    <input type="number" name="telefono" id="telefono" placeholder="Teléfono" class="form-control">
                    <!-- calendario!! 
                        fecha nacimiento -->

                </div>
                <div class="col-md-4">
                    <h3>Sobre tu cuenta</h3>
                    <input type="text" name="correo" id="correo" placeholder="Correo electrónico" class="form-control">
                    <input type="number" name="tarjeta" id="tarjeta" placeholder="Número de tarjeta" class="form-control">
                    <input type="password" name="pass" id="pass" placeholder="Contraseña" class="form-control">
                    <input type="password" name="pass2" id="pass2" placeholder="Repita la contraseña" class="form-control">
                    <button type="button" name="btnRegistrar" id="btnRegistrar" class="btn bnt-success">Guardar</button>
                </div>
            </form>
            <!-- Fin formulario de registro -->
        </div>

    </div>
@endsection