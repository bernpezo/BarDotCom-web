<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local_comercial extends Model
{
    protected $fillable = [
        'idAdmin', 'nombre', 'rut', 'logo', 'email', 'direccion', 'comuna', 'telefono', 'rubro', 'descripcion',
    ];
}
