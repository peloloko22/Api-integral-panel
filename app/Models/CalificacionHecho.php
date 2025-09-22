<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalificacionHecho extends Model
{
    protected $table = 'calificacion_hechos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'codigo_snic',
        'codigo_sat',
    ];

    public function tipificaciones()
    {
        return $this->belongsToMany(TipificacionDelito::class, 'calificacion_tipificaciones');
    }
}
