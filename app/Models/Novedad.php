<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Novedad extends Model
{
    protected $table = 'novedades';

    public const RELACIONES_COMPLETAS = [
        'delitos.tipificacionDelito.categoria',
        'vehiculos.vehiculo.tipoVehiculo',
        'dependencia.departamental',
        'fiscal',
        'tipo_novedad',
        'barrio.localidad',
        'user.sexo',
        'siniestro',
        'siniestro.tipoSiniestro',
        'siniestro.participantes.persona',
        'siniestro.participantes.rolParticipante',
        'multimedias',
        'delitos.modusOperandi',
        'delitos.calificacion',
        'personas.persona',
        'personas.rolPersona',
        'vehiculos.vehiculo',
        'elementos.categoriaElemento',
        'elementos.estadoElemento',
    ];

    protected $casts = [
        'id'                => 'integer',
        'tipo_novedad_id'   => 'integer',
        'dependencia_id'    => 'integer',
        'user_id'           => 'integer',
        'fiscal_id'         => 'integer',
        'barrio_id'         => 'integer',
        'revisada'          => 'integer',
        'incluir_parte'     => 'integer',
        'latitud'           => 'float',
        'longitud'          => 'float',
    ];

    protected $fillable = [
        'detalle_sintesis',
        'hora_hecho',
        'calle_ruta',
        'altura_km',
        'mas_detalles_direccion',
        'fiscal_id',
        'tipo_novedad_id',
        'barrio_id',
        'dependencia_id',
        'user_id',
        'latitud',
        'longitud',
        'siniestro_id',
        'incluir_parte',
        'revisada',
    ];

    public function fiscal()
    {
        return $this->belongsTo(Fiscal::class);
    }

    public function tipo_novedad()
    {
        return $this->belongsTo(TipoNovedad::class);
    }

    public function barrio()
    {
        return $this->belongsTo(Barrio::class);
    }

    public function dependencia()
    {
        return $this->belongsTo(Dependencia::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function participantes()
    {
        return $this->hasMany(SiniestroParticipante::class);
    }

    public function multimedias()
    {
        return $this->hasMany(MultimediaNovedad::class);
    }

    public function delitos()
    {
        return $this->hasMany(DelitoNovedad::class);
    }

    public function personas()
    {
        return $this->hasMany(PersonaNovedad::class);
    }

    public function vehiculos()
    {
        return $this->hasMany(VehiculoNovedad::class);
    }

    public function elementos()
    {
        return $this->hasMany(ElementoNovedad::class);
    }

    public function siniestro()
    {
        return $this->hasOne(SiniestroVialNovedad::class);
    }
}
