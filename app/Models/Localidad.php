<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $table = 'localidades';

    protected $fillable = [
        'nombre',
        'codigo',
        'departamento_id',
        'municipio_id',
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function barrios()
    {
        return $this->hasMany(Barrio::class);
    }
}
