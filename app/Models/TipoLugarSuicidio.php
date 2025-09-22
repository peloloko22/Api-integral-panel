<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoLugarSuicidio extends Model
{
    protected $table = 'tipo_lugar_suicidios';
    protected $fillable = ['nombre', 'codigo'];
}
