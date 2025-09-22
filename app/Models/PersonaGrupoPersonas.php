<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonaGrupoPersonas extends Model
{
    protected $table = 'persona_grupo_personas';

    protected $fillable = [
        'persona_id',
        'grupo_persona_id',
    ];

    public function persona()
    {
        return $this->belongsTo(User::class, 'persona_id');
    }

    public function grupoPersona()
    {
        return $this->belongsTo(GrupoPersonas::class, 'grupo_persona_id');
    }
}
