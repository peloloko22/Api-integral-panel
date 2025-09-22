<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamental extends Model
{

    protected $table = 'departamentales';

    protected $fillable = [
        'nombre',
        'codigo'
    ];

    public function dependencias()
    {
        return $this->hasMany(Dependencia::class);
    }

    public function denuncias()
    {
        return $this->hasManyThrough(
            Denuncia::class,
            Dependencia::class,
            'departamental_id', // Foreign key on dependencias table
            'dependencia_id', // Foreign key on denuncias table
            'id', // Local key on departamentales table
            'id' // Local key on dependencias table
        );
    }
}
