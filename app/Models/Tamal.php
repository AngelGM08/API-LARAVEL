<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tamal extends Model
{
    protected $table = 'tamal';
    protected $primaryKey = 'id_tamal';
    protected $fillable = [
        'nombre_tamal',
        'descripcion'
    ];
}
