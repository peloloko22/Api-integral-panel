<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $fillable = [
        'nombre',
        'codigo',
        'departamento_id',
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function localidades()
    {
        return $this->hasMany(Localidad::class);
    }
}
