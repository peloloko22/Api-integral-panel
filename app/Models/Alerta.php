<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{

    protected $table = 'alertas';

    protected $fillable = [
        'tipo_alerta_id',
        'novedad_id',
        'titulo',
        'descripcion',
        'fecha_hora_envio',
        'enviada',
    ];

    public function tipoAlerta()
    {
        return $this->belongsTo(TipoAlerta::class);
    }

    public function novedad()
    {
        return $this->belongsTo(Novedad::class);
    }
}
