<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroHecho extends Model
{
    protected $table = 'registro_hechos';

    protected $fillable = [
        'tipificacion_id',
        'calificacion_id',
        'modus_id',
        'mecanismo_arma_id',
        'imputado_conocido',
        'imputado_id',
        'victima_id',
        'victima_vinculo_id',
        'es_femicidio',
        'tipo_transporte_imputado_id',
        'violencia_genero',
        'consecuencia_hecho_id',
        'posee_boton_antipanico',

    ];


    public function esclarecimientoHecho()
    {
        return $this->hasOne(EsclarecimientoHecho::class, 'registro_hecho_id');
    }

    public function tipificacion()
    {
        return $this->belongsTo(TipificacionDelito::class);
    }

    public function calificacion()
    {
        return $this->belongsTo(CalificacionHecho::class);
    }

    public function modus()
    {
        return $this->belongsTo(ModusOperandi::class);
    }

    public function mecanismoArma()
    {
        return $this->belongsTo(MecanismoArma::class);
    }

    public function imputado()
    {
        return $this->belongsTo(Personas::class);
    }

    public function victima()
    {
        return $this->belongsTo(Personas::class);
    }

    public function victimaVinculo()
    {
        return $this->belongsTo(VinculoVictima::class);
    }

    public function tipoTransporteImputado()
    {
        return $this->belongsTo(TipoTransporteInputado::class);
    }

    public function consecuenciaHecho()
    {
        return $this->belongsTo(ConsecuenciaHecho::class);
    }
}
