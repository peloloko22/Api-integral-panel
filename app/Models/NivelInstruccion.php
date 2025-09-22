<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NivelInstruccion extends Model
{
    protected $fillable = ['nombre', 'descripcion'];
    protected $table = 'nivel_instrucciones';
}
