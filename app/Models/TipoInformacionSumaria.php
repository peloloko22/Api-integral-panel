<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoInformacionSumaria extends Model
{
    protected $table = 'tipo_informacion_sumarias';
    protected $fillable = ['nombre'];

    public function informacionSumaria()
    {
        return $this->hasMany(InformacionSumariaRegistro::class);
    }

    
}
