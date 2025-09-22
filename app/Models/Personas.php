<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    protected $table = 'personas';


    protected $fillable = [
        "alias",
        'nombre',
        'apellido',
        'dni',
        'telefono',
        'tipo_persona_id',
        'genero_id',
        'nacionalidad_id',
        'sexo_id',
        'condicion_persona_id',
        'ocupacion_id',
        'nivel_instruccion_id',
        'fecha_nacimiento',
        'domicilio',
        'clase',
        'no_identificable',
        'no_identificable_nombre',
        'capacidad_persona_id',
        'estado_civil_id',
    ];

    const RELACIONES_COMPLETAS = [
        'sexo',
        'estadoCivil',
        'capacidadPersona',
        'tipoPersona',
        'genero',
        'nacionalidad',
        'condicionPersona',
        'ocupacion',
        'nivelInstruccion',
    ];

    public function estadoCivil()
    {
        return $this->belongsTo(EstadoCivil::class);
    }

    public function capacidadPersona()
    {
        return $this->belongsTo(CapacidadPersona::class);
    }

    public function tipoPersona()
    {
        return $this->belongsTo(TipoPersona::class);
    }

    public function genero()
    {
        return $this->belongsTo(Genero::class);
    }

    public function nacionalidad()
    {
        return $this->belongsTo(Nacionalidad::class);
    }

    public function sexo()
    {
        return $this->belongsTo(Sexos::class);
    }

    public function condicionPersona()
    {
        return $this->belongsTo(CondicionPersona::class);
    }

    public function ocupacion()
    {
        return $this->belongsTo(Ocupacion::class);
    }

    public function nivelInstruccion()
    {
        return $this->belongsTo(NivelInstruccion::class);
    }

    public function personaNovedades()
    {
        return $this->hasMany(PersonaNovedad::class, 'persona_id', 'id');
    }
}
