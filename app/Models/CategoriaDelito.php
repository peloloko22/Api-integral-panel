<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaDelito extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        "codigo_snic",
        "codigo_sat",
    ];

    public function tipificaciones()
    {
        return $this->hasMany(TipificacionDelito::class);
    }

    public function novedades()
    {
        return $this->hasManyThrough(
            Novedad::class,
            TipificacionDelito::class,
            'categoria_delito_id', // foreign key en TipificacionDelito
            'id', // llave en Novedades que se asocia indirectamente
            'id', // llave local en CategoriaDelito
            'id'  // llave local en TipificacionDelito
        );
    }
}
