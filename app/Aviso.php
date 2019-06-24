<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aviso extends Model
{
    protected $fillable = [
        'idAdmin', 'nombre', 'descripcion',
    ];
}
