<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tamal;

class Produccion extends Model
{
    protected $table = 'produccion';
    protected $primaryKey = 'id_produccion';

    protected $fillable = [
        'id_tamal',
        'fecha',
        'cantidad_total',
    ];

    public function tamal()
    {
         return $this->belongsTo(Tamal::class, 'id_tamal');
    }
}
