<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Registro as RequestsRegistro;
use App\Models\Registro;
use App\Models\EsclarecimientoHecho;
use Illuminate\Http\Request;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Registro::query();
        $query->orderByDesc('created_at');

        if ($request->has('tipo_registro_id')) {
            $query->where('tipo_registro_id', $request->tipo_registro_id);
        }
        if ($request->has('departamental_id')) {
            $query->where('departamental_id', $request->departamental_id);
        }

        if ($request->has('dependencia_id')) {
            $query->where('dependencia_id', $request->dependencia_id);
        }


        $query->with(["tipoRegistro", "departamental", "dependencia", "denuncia", "tiempoEspacio"]);

        if ($request->boolean('all')) {
            return $query->get();
        }

        return $query->paginate($request->get('per_page', 10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestsRegistro $request)
    {
        $data = $request->validated();

        // Crear el registro principal
        $registro = Registro::create([
            'denuncia_id' => $data['denuncia_id'] ?? null,
            'tipo_registro_id' => $data['tipo_registro_id'] ?? null,
            'departamental_id' => $data['departamental_id'] ?? null,
            'dependencia_id' => $data['dependencia_id'] ?? null,
        ]);

        // Crear tiempo_espacio si existe
        if (!empty($data['tiempo_espacio'])) {
            $tiempoEspacioData = $data['tiempo_espacio'];
            $tiempoEspacioData['registro_id'] = $registro->id;
            $registro->tiempoEspacio()->create($tiempoEspacioData);
        }

        // Crear hechos si existen
        if (!empty($data['hechos'])) {
            foreach ($data['hechos'] as $hechoData) {
                // Extraer datos del esclarecimiento si existen
                $esclarecimientoData = [];
                if (isset($hechoData['tipo_esclarecimiento_hecho_id'])) {
                    $esclarecimientoData = [
                        'tipo_esclarecimiento_hecho_id' => $hechoData['tipo_esclarecimiento_hecho_id'],
                        'descripcion' => $hechoData['descripcion'] ?? null,
                        'dependencia_esclarece' => $hechoData['dependencia_esclarece'] ?? null,
                        'fecha_esclarecimiento' => $hechoData['fecha_esclarecimiento'] ?? null,
                    ];

                    // Remover los campos de esclarecimiento de los datos del hecho
                    unset($hechoData['tipo_esclarecimiento_hecho_id']);
                    unset($hechoData['descripcion']);
                    unset($hechoData['dependencia_esclarece']);
                    unset($hechoData['fecha_esclarecimiento']);
                }

                $hechoData['registro_id'] = $registro->id;
                $hecho = $registro->hechos()->create($hechoData);

                // Crear esclarecimiento si existe
                if (!empty($esclarecimientoData)) {
                    $esclarecimientoData['registro_hecho_id'] = $hecho->id;
                    EsclarecimientoHecho::create($esclarecimientoData);
                }
            }
        }

        // Crear personas si existen
        if (!empty($data['personas'])) {
            foreach ($data['personas'] as $personaData) {
                $personaData['registro_id'] = $registro->id;
                $registro->personas()->create($personaData);
            }
        }

        // Crear vehículos si existen
        if (!empty($data['vehiculos'])) {
            foreach ($data['vehiculos'] as $vehiculoData) {
                $vehiculoData['registro_id'] = $registro->id;
                $registro->vehiculos()->create($vehiculoData);
            }
        }

        // Crear elementos si existen
        if (!empty($data['elementos'])) {
            foreach ($data['elementos'] as $elementoData) {
                $elementoData['registro_id'] = $registro->id;
                $registro->elementos()->create($elementoData);
            }
        }

        // Crear siniestro si existe
        if (!empty($data['siniestro'])) {
            $siniestroData = $data['siniestro'];
            $participantes = $siniestroData['participantes'] ?? [];
            unset($siniestroData['participantes']); // Remover participantes del array principal

            $siniestroData['registro_id'] = $registro->id;
            $siniestro = $registro->siniestro()->create($siniestroData);

            // Crear participantes del siniestro
            if (!empty($participantes)) {
                foreach ($participantes as $participanteData) {
                    $participanteData['siniestro_vial_id'] = $siniestro->id;
                    $siniestro->participantes()->create($participanteData);
                }
            }
        }

        // Crear suicidios si existen
        if (!empty($data['suicidios'])) {
            foreach ($data['suicidios'] as $suicidioData) {
                $suicidioData['registro_id'] = $registro->id;
                $registro->suicidio()->create($suicidioData);
            }
        }

        // Crear información sumaria si existe
        if (!empty($data['informacion_sumaria'])) {
            foreach ($data['informacion_sumaria'] as $infoSumariaData) {
                // Extraer datos de personas si existen
                $personasData = $infoSumariaData['personas'] ?? [];
                unset($infoSumariaData['personas']); // Remover personas del array principal

                $infoSumariaData['registro_id'] = $registro->id;
                $informacionSumaria = $registro->informacionSumaria()->create($infoSumariaData);

                // Crear personas asociadas a la información sumaria
                if (!empty($personasData)) {
                    foreach ($personasData as $personaData) {
                        $personaData['informacion_sumaria_registro_id'] = $informacionSumaria->id;
                        $informacionSumaria->personasInformacionSumaria()->create($personaData);
                    }
                }
            }
        }

        $query = Registro::with(Registro::RELACIONES);
        $registro = $query->findOrFail($registro->id);
        // Cargar las relaciones para la respuesta


        return response()->json($registro, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Registro $registro)
    {
        // Eager loading optimizado - carga todas las relaciones desde la consulta inicial
        $registro = Registro::with(Registro::RELACIONES)->findOrFail($registro->id);

        return response()->json($registro);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(RequestsRegistro $request, Registro $registro)
    {
        $data = $request->validated();

        // Actualizar el registro principal
        $registro->update([
            'denuncia_id' => $data['denuncia_id'] ?? $registro->denuncia_id,
            'tipo_registro_id' => $data['tipo_registro_id'] ?? $registro->tipo_registro_id,
            'departamental_id' => $data['departamental_id'] ?? $registro->departamental_id,
            'dependencia_id' => $data['dependencia_id'] ?? $registro->dependencia_id,
        ]);

        // Actualizar información sumaria si existe
        if (isset($data['informacion_sumaria'])) {
            // Eliminar información sumaria existente (cascade eliminará las personas asociadas)
            $registro->informacionSumaria()->delete();

            // Crear nueva información sumaria
            foreach ($data['informacion_sumaria'] as $infoSumariaData) {
                // Extraer datos de personas si existen
                $personasData = $infoSumariaData['personas'] ?? [];
                unset($infoSumariaData['personas']); // Remover personas del array principal

                $infoSumariaData['registro_id'] = $registro->id;
                $informacionSumaria = $registro->informacionSumaria()->create($infoSumariaData);

                // Crear personas asociadas a la información sumaria
                if (!empty($personasData)) {
                    foreach ($personasData as $personaData) {
                        $personaData['informacion_sumaria_registro_id'] = $informacionSumaria->id;
                        $informacionSumaria->personasInformacionSumaria()->create($personaData);
                    }
                }
            }
        }

        // Cargar las relaciones actualizadas para la respuesta
        $registro = Registro::with(Registro::RELACIONES)->findOrFail($registro->id);

        return response()->json($registro);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Registro $registro)
    {
        $registro->delete();
        return response()->json(null, 204);
    }
}
