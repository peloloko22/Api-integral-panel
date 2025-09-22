<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolSiniestro extends Model
{
    protected $table = 'rol_siniestros';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];
    public function personas()
    {
        return $this->hasMany(SiniestroParticipante::class, 'rol_siniestro_id');
    }
}
