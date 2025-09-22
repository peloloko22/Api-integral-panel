<?php

namespace App\Http\Controllers;

use App\Models\CategoriaElemento;
use App\Models\Dependencia;
use App\Models\EstadoElemento;
use App\Models\RolPersona;
use App\Models\TipificacionDelito;
use App\Models\TipoLugar;
use App\Models\TipoSiniestro;
use App\Models\TipoVehiculo;
use App\Models\TipoVia;
use App\Models\TipoZona;

class EmpaquetadoDataController extends Controller
{

    // esta funcion debe devolver un json con mucha informacion:
    // tipo lugar
    // tipo via
    // tipo vehiculo
    // tipo zona
    // tipificacion delito
    // tipo siniestro
    // estado elemento
    // categoria elemento
    // dependencia

    public function empaquetadoData()
    {
        $data = [
            'tipo_lugar' => TipoLugar::all(),
            'tipo_via' => TipoVia::all(),
            'tipo_vehiculo' => TipoVehiculo::all(),
            'tipo_zona' => TipoZona::all(),
            'tipificacion_delito' => TipificacionDelito::all(),
            'tipo_siniestro' => TipoSiniestro::all(),
            'estado_elemento' => EstadoElemento::all(),
            'categoria_elemento' => CategoriaElemento::all(),
            'dependencia' => Dependencia::all(),
            'rol_persona' => RolPersona::all()
        ];

        return response()->json($data);
    }
}
