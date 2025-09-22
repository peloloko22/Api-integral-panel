<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{

    protected $table = 'provincias';

    protected $fillable = [
        'nombre',
        'codigo',
    ];

    public function departamentos()
    {
        return $this->hasMany(Departamento::class);
    }
}
