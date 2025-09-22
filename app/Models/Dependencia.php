<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{
    protected $fillable = [
        'nombre',
        'codigo',
        'departamental_id',
    ];

    public function departamental()
    {
        return $this->belongsTo(Departamental::class);
    }

    public function novedades()
    {
        return $this->hasMany(Novedad::class);
    }

    public function denuncias()
    {
        return $this->hasMany(Denuncia::class);
    }
}
