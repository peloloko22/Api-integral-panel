<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehiculoRegistro extends Model
{



    protected $table = 'vehiculo_registros';

    protected $fillable = [
        'vehiculo_id',
        'descripcion',
        'estado_vehiculo_registro_id',
    ];

    public function registro()
    {
        return $this->belongsTo(Registro::class);
    }

    public function estadoVehiculo()
    {
        return $this->belongsTo(EstadoVehiculoRegistro::class);
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }
}
