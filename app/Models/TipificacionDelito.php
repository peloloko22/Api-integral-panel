<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipificacionDelito extends Model
{
    protected $table = 'tipificacion_delitos';

    protected $fillable = [
        'nombre',
        "descripcion",
        'categoria_delito_id',
        "codigo_snic",
        "codigo_sat",
        "homicidio",
    ];

    public function mecanismoArmas()
    {
        return $this->belongsToMany(MecanismoArma::class, 'mecanismo_arma_tipificaciones', 'tipificacion_id', 'mecanismo_arma_id');
    }

    public function modusOperandis()
    {
        return $this->belongsToMany(ModusOperandi::class, 'modus_operandi_tipificaciones');
    }

    public function calificaciones()
    {
        return $this->belongsToMany(CalificacionHecho::class, 'calificacion_tipificaciones', "tipificacion_id", "calificacion_id");
    }

    public function categoria()
    {
        return $this->belongsTo(CategoriaDelito::class, 'categoria_delito_id');
    }

    public function novedades()
    {
        return $this->belongsToMany(Novedad::class, 'delitos_novedades');
    }
}
