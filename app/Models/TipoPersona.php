<?php

namespace App\Models;

use App\Http\Requests\Persona;
use Illuminate\Database\Eloquent\Model;

class TipoPersona extends Model
{
    protected $table = 'tipo_personas';
    protected $fillable = ['nombre', 'codigo_sat', 'codigo_snic'];

    public function personas()
    {
        return $this->hasMany(Persona::class, 'tipo_persona_id');
    }
}
