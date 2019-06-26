<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    protected $fillable = [
        'idLocal', 'idUsuario', 'idCliente', 'idMesa','total', 'estado', 'fecha',
    ];
}
