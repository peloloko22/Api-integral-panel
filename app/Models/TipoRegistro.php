<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoRegistro extends Model
{
    protected $table = 'tipo_registros';

    protected $fillable = [
        'nombre',
        "codigo_sat",
        "codigo_snic",
    ];

    public function registros()
    {
        return $this->hasMany(Registro::class, 'tipo_registro_id');
    }
}
