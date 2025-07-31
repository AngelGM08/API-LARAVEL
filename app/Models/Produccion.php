<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produccion extends Model
{
    protected $table = 'produccion';
    protected $primaryKey = 'id_produccion';
    protected $fillable = [
        'id_platillo',
        'fecha',
        'cantidad_total',
    ];
}
