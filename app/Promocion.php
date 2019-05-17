<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    protected $fillable = [
        'idLocal', 'nombre', 'descripcion', 'imagen',
    ];
}
