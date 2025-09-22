<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoLugarSiniestroVial extends Model
{

    protected $table = 'tipo_lugar_siniestro_viales';
    protected $fillable = ['nombre', 'codigo_sat'];
}
