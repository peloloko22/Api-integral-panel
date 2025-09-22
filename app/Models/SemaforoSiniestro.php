<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SemaforoSiniestro extends Model
{
    protected $table = 'semaforo_siniestros';

    protected $fillable = ['nombre', 'codigo'];

    public function siniestros()
    {
        return $this->hasMany(SiniestroVialRegistro::class, 'semaforo_siniestro_id');
    }
}
