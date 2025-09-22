<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $fillable = [
        'nombre',
        'codigo',
        'provincia_id',
    ];

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function municipios()
    {
        return $this->hasMany(Municipio::class);
    }

    public function localidades()
    {
        return $this->hasMany(Localidad::class);
    }
}
