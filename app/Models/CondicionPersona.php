<?php

namespace App\Models;

use App\Http\Requests\Persona;
use Illuminate\Database\Eloquent\Model;

class CondicionPersona extends Model
{
    protected $fillable = ['nombre', 'codigo_sat', 'codigo_snic'];

    public function persona()
    {
        return $this->hasMany(Persona::class, 'condicion_persona_id');
    }
}
