<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{
    protected $fillable = [
        'nombre',
        'codigo',
        'localidad_id',
    ];

    public function localidad()
    {
        return $this->belongsTo(Localidad::class);
    }

    public function novedades()
    {
        return $this->hasMany(Novedad::class);
    }
}
