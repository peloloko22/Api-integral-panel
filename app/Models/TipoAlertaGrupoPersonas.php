<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoAlertaGrupoPersonas extends Model
{
    protected $table = 'tipo_alerta_grupo_personas';

    protected $fillable = [
        'grupo_persona_id',
        'tipo_alerta_id',
    ];

    public function grupoPersonas()
    {
        return $this->belongsToMany(GrupoPersonas::class, 'grupo_personas_tipo_alerta', 'tipo_alerta_id', 'grupo_persona_id');
    }


}
