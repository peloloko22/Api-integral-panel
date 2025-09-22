<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fiscal extends Model
{

    protected $table = 'fiscales';
    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'telefono',
    ];

    public function novedades()
    {
        return $this->hasMany(Novedad::class);
    }
}
