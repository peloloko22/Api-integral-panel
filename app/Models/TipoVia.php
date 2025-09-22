<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoVia extends Model
{
    protected $table = 'tipo_vias';
    protected $fillable = [
        'nombre',
    ];

}
