<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sexos extends Model
{
    protected $table = 'sexos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'codigo_sat',
        'codigo_snic'
    ];

}
