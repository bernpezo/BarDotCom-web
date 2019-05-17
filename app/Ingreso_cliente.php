<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso_cliente extends Model
{
    protected $fillable = [
        'idUsuario', 'idCliente', 'idLocal', 'idMesa',
    ];
}
