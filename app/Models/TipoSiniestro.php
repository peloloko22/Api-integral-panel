<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoSiniestro extends Model
{
    protected $table = 'tipo_siniestros';

    protected $fillable = ['nombre', 'descripcion'];

    public function siniestros()
    {
        return $this->hasMany(SiniestroVialRegistro::class, 'tipo_siniestro_id');
    }
}
