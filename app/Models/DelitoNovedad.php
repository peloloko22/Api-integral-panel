<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DelitoNovedad extends Model
{
    protected $table = 'delitos_novedades';

    protected $fillable = [
        'novedad_id',
        'tipificacion_delito_id',
        'calificacion_id',
        'modus_operandi_id'
    ];

    public $timestamps = true;

    public function novedad()
    {
        return $this->belongsTo(Novedad::class);
    }

    public function tipificacionDelito()
    {
        return $this->belongsTo(TipificacionDelito::class);
    }

    public function calificacion()
    {
        return $this->belongsTo(CalificacionHecho::class);
    }

    public function modusOperandi()
    {
        return $this->belongsTo(ModusOperandi::class);
    }

}
