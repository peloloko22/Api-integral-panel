<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoAlerta extends Model
{
    protected $table = 'tipo_alertas';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function jerarquias()
    {
        return $this->belongsToMany(Jerarquia::class, 'alerta_jerarquias', 'tipo_alerta_id', 'jerarquia_id');
    }

    public function gruposPersonas()
    {
        return $this->belongsToMany(GrupoPersonas::class, 'tipo_alerta_grupo_personas', 'tipo_alerta_id', 'grupo_persona_id');
    }
}
