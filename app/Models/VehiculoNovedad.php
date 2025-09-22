<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehiculoNovedad extends Model
{


    protected $table = 'vehiculos_novedades';
    protected $fillable = [
        'novedad_id',
        'vehiculo_id',
    ];

    public function novedad()
    {
        return $this->belongsTo(Novedad::class);
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id');
    }

}
