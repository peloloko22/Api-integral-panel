<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoFormularioAyuda extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function formularios()
    {
        return $this->hasMany(FormularioAyuda::class);
    }


}
