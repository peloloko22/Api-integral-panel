<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoSuicidio extends Model
{
    protected $fillable = ['nombre', 'codigo_sat'];

    public function suicidios()
    {
        return $this->hasMany(SuicidioRegistro::class);
    }
}
