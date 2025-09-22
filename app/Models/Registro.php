<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{

    public const RELACIONES = [
        "tipoRegistro",
        "departamental",
        "dependencia",
        "denuncia",
        "tiempoEspacio",
        "tiempoEspacio.localidad",
        "tiempoEspacio.tipoLugar",
        "tiempoEspacio.tipoVia",
        "tiempoEspacio.paraje",
        "tiempoEspacio.barrio",
        "tiempoEspacio.franjaHoraria",
        "tiempoEspacio.tipoZona",
        "personas.persona",
        "personas.persona.sexo",
        "personas.persona.estadoCivil",
        "personas.persona.capacidadPersona",
        "personas.persona.tipoPersona",
        "personas.persona.genero",
        "personas.persona.nacionalidad",
        "personas.persona.condicionPersona",
        "personas.persona.ocupacion",
        "personas.persona.nivelInstruccion",
        "personas.rolPersonaRegistro",
        "hechos",
        "hechos.tipificacion",
        "hechos.calificacion",
        "hechos.modus",
        "hechos.mecanismoArma",
        "hechos.imputado",
        "hechos.victima",
        "hechos.victimaVinculo",
        "hechos.tipoTransporteImputado",
        "hechos.consecuenciaHecho",
        "hechos.esclarecimientoHecho",
        "hechos.esclarecimientoHecho.tipoEsclarecimientoHecho",
        "vehiculos",
        "elementos",
        "elementos.categoriaElemento",
        "elementos.estadoElemento",
        "elementos.tipoMoneda",
        "siniestro",
        "siniestro.tipoSiniestro",
        "siniestro.semaforoSiniestro",
        "siniestro.condicionClimatica",
        "siniestro.tipoLugarSiniestroVial",
        "siniestro.participantes",
        "siniestro.participantes.persona",
        "siniestro.participantes.vehiculo",
        "siniestro.participantes.rolParticipante",
        "suicidio",
        "suicidio.testigo",
        "suicidio.suicida",
        "suicidio.tipoLugarSuicidio",
        "suicidio.mecanismoSuicidio",
        "suicidio.tipoSuicidio",
        "informacionSumaria",
        "informacionSumaria.tipoInformacionSumaria",
        "informacionSumaria.personasInformacionSumaria",
        "informacionSumaria.personasInformacionSumaria.persona",
    ];

    protected $table = 'registros';

    protected $fillable = [
        'denuncia_id',
        'tipo_registro_id',
        'departamental_id',
        'dependencia_id',
    ];


    public function informacionSumaria()
    {
        return $this->hasMany(InformacionSumariaRegistro::class);
    }

    public function denuncia()
    {
        return $this->belongsTo(Denuncia::class);
    }

    public function tipoRegistro()
    {
        return $this->belongsTo(TipoRegistro::class);
    }

    public function departamental()
    {
        return $this->belongsTo(Departamental::class);
    }

    public function dependencia()
    {
        return $this->belongsTo(Dependencia::class);
    }

    public function tiempoEspacio()
    {
        return $this->hasOne(TiempoEspacioRegistro::class);
    }

    public function hechos()
    {
        return $this->hasMany(RegistroHecho::class);
    }

    public function personas()
    {
        return $this->hasMany(PersonaRegistro::class);
    }

    public function vehiculos()
    {
        return $this->hasMany(VehiculoRegistro::class);
    }

    public function siniestro()
    {
        return $this->hasOne(SiniestroVialRegistro::class);
    }

    public function suicidio()
    {
        return $this->hasMany(SuicidioRegistro::class);
    }

    public function elementos()
    {
        return $this->hasMany(ElementoRegistro::class);
    }
}
