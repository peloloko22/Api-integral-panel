<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiempoEspacioRegistro extends Model
{
    protected $table = 'tiempo_espacio_registros';
    protected $fillable = ['registro_id', 'localidad_id', 'tipo_lugar_id', 'tipo_via_id', 'paraje_id', 'barrio_id', 'fecha_hecho', 'fecha_denuncia', 'dia_de_la_semana', 'franja_horaria_id', 'calle_ruta', 'altura_km', 'mas_detalles_direccion', 'tipo_zona_id', 'latitud', 'longitud'];

    protected $casts = [
        'latitud' => 'double',
        'longitud' => 'double',
    ];

    public function registro()
    {
        return $this->belongsTo(Registro::class);
    }

    public function localidad()
    {
        return $this->belongsTo(Localidad::class);
    }

    public function tipoLugar()
    {
        return $this->belongsTo(TipoLugar::class);
    }

    public function tipoVia()
    {
        return $this->belongsTo(TipoVia::class);
    }

    public function paraje()
    {
        return $this->belongsTo(Paraje::class);
    }

    public function barrio()
    {
        return $this->belongsTo(Barrio::class);
    }

    public function franjaHoraria()
    {
        return $this->belongsTo(FranjaHoraria::class);
    }

    public function tipoZona()
    {
        return $this->belongsTo(TipoZona::class);
    }
}
