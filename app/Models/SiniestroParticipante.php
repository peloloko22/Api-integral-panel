<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiniestroParticipante extends Model
{
    protected $table = 'siniestro_novedad_participantes';

    protected $fillable = [
        'siniestro_id',
        'persona_id',
        'vehiculo_id',
        'rol_siniestro_id',
    ];

    public function persona()
    {
        return $this->belongsTo(Personas::class, 'persona_id');
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id');
    }

    public function rolParticipante()
    {
        return $this->belongsTo(RolSiniestro::class, 'rol_siniestro_id');
    }


}
