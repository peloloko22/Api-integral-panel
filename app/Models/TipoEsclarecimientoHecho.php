<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEsclarecimientoHecho extends Model
{
    protected $table = 'tipo_esclarecimiento_hechos';
    protected $fillable = ['nombre'];

    public function esclarecimientoHechos()
    {
        return $this->hasMany(EsclarecimientoHecho::class);
    }
}
