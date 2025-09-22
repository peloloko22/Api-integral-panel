<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonaNovedad extends Model
{

    protected $table = 'persona_novedades';
    protected $fillable = [
        'novedad_id',
        'persona_id',
        'rol_persona_id',
        'detalles_adicionales',
    ];

    public function persona()
    {
        return $this->belongsTo(Personas::class, 'persona_id', 'id');
    }


    public function novedad()
    {
        return $this->belongsTo(Novedad::class);
    }


    public function rolPersona()
    {
        return $this->belongsTo(RolPersona::class, 'rol_persona_id');
    }

   
}
