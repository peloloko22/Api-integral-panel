<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonaInformacionSumaria extends Model
{
    protected $table = 'persona_informacion_sumarias';

    protected $fillable = [
        'persona_id',
        'extra',
        "informacion_sumaria_registro_id",
    ];

    public function informacionSumariaRegistro()
    {
        return $this->belongsTo(InformacionSumariaRegistro::class, 'informacion_sumaria_registro_id');
    }

    public function persona()
    {
        return $this->belongsTo(Personas::class);
    }
}
