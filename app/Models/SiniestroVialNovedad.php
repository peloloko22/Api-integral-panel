<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiniestroVialNovedad extends Model
{
    protected $fillable = [
        'tipo_siniestro_id',
        'novedad_id',
        'fuga',
        'alcohol',
        'descripcion'
    ];

    protected $table = 'siniestro_vial_novedad';

    public function personas()
    {
        return $this->belongsToMany(
            PersonaNovedad::class,
            'siniestro_novedad_participantes',
            'siniestro_id',
            'persona_novedad_id'
        )->whereNotNull('persona_novedad_id');
    }

    public function vehiculos()
    {
        return $this->belongsToMany(
            VehiculoNovedad::class,
            'siniestro_novedad_participantes',
            'siniestro_id',
            'vehiculo_novedad_id'
        )->whereNotNull('vehiculo_novedad_id');
    }


    public function tipoSiniestro()
    {
        return $this->belongsTo(TipoSiniestro::class);
    }

    public function participantes()
    {
        return $this->hasMany(SiniestroParticipante::class, 'siniestro_id');
    }

    public function novedad()
    {
        return $this->belongsTo(Novedad::class);
    }
}
