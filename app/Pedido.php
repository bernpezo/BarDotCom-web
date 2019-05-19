<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'idLocal', 'idUsuario', 'idCliente', 'idCuenta', 'idMesa', 'idItem', 'cantidadItem', 'estado', 'fecha',
    ];
}
