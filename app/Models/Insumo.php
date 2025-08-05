<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $table = 'insumos';

    protected $fillable = [
        'id_produccion',
        'id_compra',
        'cantidad_usada',
    ];

    public function produccion()
    {
        return $this->belongsTo(Produccion::class, 'id_produccion');
    }

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'id_compra');
    }
}
