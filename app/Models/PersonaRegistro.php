<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonaRegistro extends Model
{
    protected $table = 'persona_registros';
    protected $fillable = ['persona_id', 'rol_persona_registro_id'];

    public function persona()
    {
        return $this->belongsTo(Personas::class);
    }

    public function rolPersonaRegistro()
    {
        return $this->belongsTo(RolPersona::class);
    }
    
}
