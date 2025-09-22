<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EsclarecimientoHecho extends Model
{
    protected $table = 'esclarecimiento_hechos';
    protected $fillable = ['registro_hecho_id', 'tipo_esclarecimiento_hecho_id', 'descripcion', 'dependencia_esclarece', 'fecha_esclarecimiento'];

    public function registroHecho()
    {
        return $this->belongsTo(RegistroHecho::class);
    }

    public function tipoEsclarecimientoHecho()
    {
        return $this->belongsTo(TipoEsclarecimientoHecho::class);
    }
}
