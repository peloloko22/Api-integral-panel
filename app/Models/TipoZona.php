<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoZona extends Model
{
    protected $table = 'tipo_zonas';
    protected $fillable = [
        'nombre',
    ];

}
