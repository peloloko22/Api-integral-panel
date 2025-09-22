<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CausaFallecimiento extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
    ];
}
