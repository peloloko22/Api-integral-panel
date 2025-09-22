<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoVehiculo extends Model
{

    protected $table = 'tipo_vehiculos';
    protected $fillable = [
        'nombre',
        'codigo_sat',
    ];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class);
    }
}
