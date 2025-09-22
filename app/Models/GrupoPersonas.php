<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrupoPersonas extends Model
{
    public const MODELOS = [
        'personas',
        'tipoAlertas',
    ];

    protected $table = 'grupo_personas';

    protected $fillable = [
        'nombre',
    ];

    public function personas()
    {
        return $this->belongsToMany(User::class, 'persona_grupo_personas', 'grupo_persona_id', 'persona_id');
    }

    public function tipoAlertas()
    {
        return $this->belongsToMany(TipoAlerta::class, 'tipo_alerta_grupo_personas', 'grupo_persona_id', 'tipo_alerta_id');
    }

}
