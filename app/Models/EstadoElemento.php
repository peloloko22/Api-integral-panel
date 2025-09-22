<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoElemento extends Model
{
    protected $table = 'estado_elementos';

    protected $fillable = [
        'nombre',
    ];


}
