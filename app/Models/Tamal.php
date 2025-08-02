<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produccion;

class Tamal extends Model
{
    protected $table = 'tamal';
    protected $primaryKey = 'id_tamal';

    protected $fillable = ['nombre_tamal'];

    public function producciones()
    {
        return $this->hasMany(Produccion::class, 'id_tamal');
    }
}
