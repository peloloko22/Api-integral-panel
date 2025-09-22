<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaElemento extends Model
{


    protected $fillable = ['nombre', 'es_dinero'];

    protected $casts = [
        'es_dinero' => 'boolean',
    ];
    
}
