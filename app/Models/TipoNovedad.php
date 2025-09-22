<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoNovedad extends Model
{
    protected  $table = 'tipo_novedades';

    protected $fillable = [
        'nombre',
        'descripcion',
        "tipo_alerta_id",
        'prioridad',
        'color',
    ];

    public function novedades()
    {
        return $this->hasMany(Novedad::class, 'tipo_novedad_id');
    }

    public function tipoAlerta()
    {
        return $this->belongsTo(TipoAlerta::class, 'tipo_alerta_id');
    }
}
