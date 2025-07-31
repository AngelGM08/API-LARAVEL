<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedor';
    protected $primaryKey = 'id_proveedor';
    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'telefono',
        'email'
    ];
}
