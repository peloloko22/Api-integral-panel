<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoVehiculoRegistro extends Model
{
    protected $table = 'estado_vehiculo_registros';
    protected $fillable = ['nombre'];
    
    public function vehiculoRegistros()
    {
        return $this->hasMany(VehiculoRegistro::class);
    }

}
