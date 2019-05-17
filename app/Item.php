<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'idLocal', 'nombre', 'descripcion', 'precio', 'estado', 'stock', 'imagen',
    ];
}
