<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoPersona extends Model
{
    protected $fillable = ['nombre'];

    /**
     * Define the relationship with the Persona model.
     */
    public function personas()
    {
        return $this->hasMany(Personas::class, 'estado_persona_id');
    }
}
