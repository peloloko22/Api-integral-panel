<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConocimientoImputado extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'codigo_snic',
        'codigo_sat',
    ];


}
