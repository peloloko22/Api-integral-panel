<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformacionSumariaRegistro extends Model
{
    protected $table = 'informacion_sumaria_registros';

    protected $fillable = [
        'registro_id',
        'tipo_informacion_sumaria_id',
        'descripcion',
    ];

    public function registro()
    {
        return $this->belongsTo(Registro::class);
    }

    public function tipoInformacionSumaria()
    {
        return $this->belongsTo(TipoInformacionSumaria::class);
    }

    public function personasInformacionSumaria()
    {
        return $this->hasMany(PersonaInformacionSumaria::class);
    }
}
