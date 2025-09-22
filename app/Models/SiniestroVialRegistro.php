<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiniestroVialRegistro extends Model
{
    protected $table = 'siniestro_vial_registros';

    protected $fillable = [
        'registro_id',
        'tipo_siniestro_id',
        'fuga',
        'alcohol',
        'semaforo_siniestro_id',
        'condicion_climatica_id',
        'tipo_lugar_siniestro_vial_id',
    ];

    // castea fuga y alcohol como boolean
    protected $casts = [
        'fuga' => 'boolean',
        'alcohol' => 'boolean',
    ];



    public function tipoLugarSiniestroVial()
    {
        return $this->belongsTo(TipoLugarSiniestroVial::class);
    }

    public function registro()
    {
        return $this->belongsTo(Registro::class);
    }

    public function tipoSiniestro()
    {
        return $this->belongsTo(TipoSiniestro::class);
    }

    public function semaforoSiniestro()
    {
        return $this->belongsTo(SemaforoSiniestro::class);
    }

    public function participantes()
    {
        return $this->hasMany(ParticipanteSiniestroRegistro::class, 'siniestro_vial_id');
    }

    public function condicionClimatica()
    {
        return $this->belongsTo(CondicionClimatica::class);
    }
}
