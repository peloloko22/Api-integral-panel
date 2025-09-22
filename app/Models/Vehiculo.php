<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{

    protected $table = 'vehiculos';

    protected $fillable = [
        'dominio',
        'tipo_vehiculo_id',
        'marca',
        'modelo',
        'color',
        'numero_motor',
        'numero_chasis',
        'extra',
        'pedido_captura',
        'no_identificable',
        'no_identificable_nombre',
    ];

    public function tipoVehiculo()
    {
        return $this->belongsTo(TipoVehiculo::class);
    }

}
