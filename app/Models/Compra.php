<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;

class Compra extends Model
{
    protected $table = 'compras';
    protected $primaryKey = 'id_compra';
    protected $fillable = [
        'id_proveedor',
        'id_producto',
        'cantidad',
        'unidad',
        'total',
    ];
        public function producto()
{
    return $this->belongsTo(Producto::class, 'id_producto');
}
}


