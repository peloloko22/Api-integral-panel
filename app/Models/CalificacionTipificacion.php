<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalificacionTipificacion extends Model
{
    protected $fillable = ['calificacion_id', 'tipificacion_id'];
    protected $table = 'calificacion_tipificaciones';

    public function calificacion()
    {
        return $this->belongsTo(CalificacionHecho::class, 'calificacion_id');
    }

    public function tipificacion()
    {
        return $this->belongsTo(TipificacionDelito::class, 'tipificacion_id');
    }
}
