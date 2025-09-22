<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Novedad\NovedadStoreRequest;
use App\Jobs\EnviarAlertaLoteUsers;
use App\Models\Alerta;
use App\Models\HistorialNovedad;
use App\Models\Novedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NovedadController extends Controller
{
    public function store(NovedadStoreRequest $request)
    {
        return DB::transaction(function () use ($request) {

            $data = $request->validated();

            $dataNovedad = [
                'detalle_sintesis' => $data['detalle_sintesis'],
                'hora_hecho' => $data['hora_hecho'],
                'calle_ruta' => $data['calle_ruta'] ?? null,
                'altura_km' => $data['altura_km'] ?? null,
                'mas_detalles_direccion' => $data['mas_detalles_direccion'] ?? null,
                'fiscal_id' => $data['fiscal_id'] ?? null,
                'tipo_novedad_id' => $data['tipo_novedad_id'],
                'barrio_id' => $data['barrio_id'] ?? null,
                'dependencia_id' => $data['dependencia_id'],
                'user_id' => $data['user_id'],
                'latitud' => $data['latitud'] ?? null,
                'longitud' => $data['longitud'] ?? null,
                'revisada' => $data['marcar_revisada'] ?? false,
                'incluir_parte' => $data['incluir_parte'] ?? false,
            ];


            $novedad = Novedad::create($dataNovedad);

            if (!empty($data['delitos'])) {
                foreach ($data['delitos'] as $delito) {
                    $novedad->delitos()->create([
                        'tipificacion_delito_id' => $delito['tipificacion_id'],
                        'modus_operandi_id' => $delito['modus_operandi_id'] ?? null,
                        'calificacion_id' => $delito['calificacion_id'] ?? null,
                    ]);
                }
            }

            $personas = [];
            if (!empty($data['personas'])) {
                foreach ($data['personas'] as $index => $personaData) {
                    $persona = $novedad->personas()->create([
                        'persona_id' => $personaData['persona_id'],
                        'rol_persona_id' => $personaData['rol_persona_id'],
                        'detalles_adicionales' => $personaData['detalles_adicionales'] ?? null,
                    ]);
                    $personas[$index] = $persona;
                }
            }

            $vehiculos = [];
            if (!empty($data['vehiculos'])) {
                foreach ($data['vehiculos'] as $index => $vehiculoData) {
                    $vehiculo = $novedad->vehiculos()->create([
                        'vehiculo_id' => $vehiculoData['vehiculo_id'],
                    ]);
                    $vehiculos[$index] = $vehiculo;
                }
            }

            if (!empty($data['elementos'])) {
                foreach ($data['elementos'] as $elementoData) {
                    $novedad->elementos()->create([
                        'estado_elemento_id' => $elementoData['estado_elemento_id'],
                        'categoria_elemento_id' => $elementoData['categoria_elemento_id'],
                        'cantidad' => $elementoData['cantidad'],
                        'valor' => $elementoData['valor'] ?? 1.0,
                        'detalles' => $elementoData['detalles'] ?? null,
                    ]);
                }
            }

            if (!empty($data['siniestro'])) {
                $siniestroData = $data['siniestro'];
                $siniestro = $novedad->siniestro()->create([
                    'tipo_siniestro_id' => $siniestroData['tipo_siniestro_id'],
                    'fuga' => $siniestroData['fuga'] ?? false,
                    'alcohol' => $siniestroData['alcohol'] ?? false,
                    'descripcion' => $siniestroData['descripcion'] ?? null,
                ]);

                foreach ($siniestroData['participantes'] as $p) {
                    $siniestro->participantes()->create([
                        'persona_id' => $p['persona_id'],
                        'vehiculo_id' => $p['vehiculo_id'] ?? null,
                        'rol_siniestro_id' => $p['rol_siniestro_id'],
                    ]);
                }
            }

            $novedad->load('tipo_novedad.tipoAlerta');

            $tipoAlerta = $novedad->tipo_novedad?->tipoAlerta;

            if ($request->hasFile('multimedia')) {
                foreach ($request->file('multimedia') as $archivo) {
                    $path = $archivo->store('multimedia', 'public');

                    $novedad->multimedias()->create([
                        'ruta' => $path,
                        'tipo' => $archivo->getMimeType(),
                    ]);
                }
            }

            if ($tipoAlerta) {
                $alerta = Alerta::create([
                    'titulo' => $tipoAlerta->nombre,
                    'descripcion' => $novedad->detalle_sintesis,
                    'tipo_alerta_id' => $tipoAlerta->id,
                    'novedad_id' => $novedad->id,
                    'enviada' => false,
                    'fecha_hora_envio' => null,
                    'enviar_ahora' => true,
                ]);

                dispatch(new EnviarAlertaLoteUsers(
                    $tipoAlerta,
                    $tipoAlerta->nombre,
                    $novedad->detalle_sintesis,
                    $alerta->id
                ));
            }

            $fullNovedad = $novedad->load(Novedad::RELACIONES_COMPLETAS);


            HistorialNovedad::create([
                'novedad_id' => $novedad->id,
                'contenido' =>  json_encode($fullNovedad->toArray()),
                'usuario_revision_id' => auth("web")->id(),
                'accion' => HistorialNovedad::ACCION_CREACION,

            ]);

            return response()->json($fullNovedad, 201);
        });
    }

    public function show($id)
    {
        $novedad = Novedad::findOrFail($id);
        $novedad->load(Novedad::RELACIONES_COMPLETAS);
        return response()->json($novedad);
    }

    public function index(Request $request)
    {
        $query = Novedad::query();
        $query->orderByDesc('created_at');

        if ($request->has('search')) {
            $query->where('detalle_sintesis', 'like', '%' . $request->input('search') . '%');
        }

        if ($request->has('fiscal_id')) {
            $query->where('fiscal_id', $request->input('fiscal_id'));
        }

        if ($request->has('dependencia_id')) {
            $query->where('dependencia_id', $request->input('dependencia_id'));
        }

        if ($request->has('user_id')) {
            $query->where('user_id', $request->input('user_id'));
        }

        if ($request->has('barrio_id')) {
            $query->where('barrio_id', $request->input('barrio_id'));
        }

        if ($request->has('tipo_novedad_id')) {
            $query->where('tipo_novedad_id', $request->input('tipo_novedad_id'));
        }

        if ($request->has('fecha_desde')) {
            $query->whereDate('created_at', '>=', $request->input('fecha_desde'));
        }

        if ($request->has('fecha_hasta')) {
            $query->whereDate('created_at', '<=', $request->input('fecha_hasta'));
        }

        if ($request->has('hora_desde')) {
            $query->whereTime('hora_hecho', '>=', $request->input('hora_desde'));
        }

        if ($request->has('hora_hasta')) {
            $query->whereTime('hora_hecho', '<=', $request->input('hora_hasta'));
        }

        if ($request->has('latitud')) {
            $query->where('latitud', $request->input('latitud'));
        }

        if ($request->has('longitud')) {
            $query->where('longitud', $request->input('longitud'));
        }

        $query->with(Novedad::RELACIONES_COMPLETAS);

        if ($request->boolean('all')) {
            return $query->get();
        }

        $perPage = $request->get('per_page', 10);
        $page = $request->get('page', 1);

        return $query->paginate($perPage, ['*'], 'page', $page);
    }

    public function update(NovedadStoreRequest $request, Novedad $novedad)
    {
        return DB::transaction(function () use ($request, $novedad) {
            $data = $request->validated();

            $novedad->update([
                'detalle_sintesis' => $data['detalle_sintesis'],
                'hora_hecho' => $data['hora_hecho'],
                'calle_ruta' => $data['calle_ruta'] ?? null,
                'altura_km' => $data['altura_km'] ?? null,
                'mas_detalles_direccion' => $data['mas_detalles_direccion'] ?? null,
                'fiscal_id' => $data['fiscal_id'] ?? null,
                'tipo_novedad_id' => $data['tipo_novedad_id'],
                'barrio_id' => $data['barrio_id'] ?? null,
                'dependencia_id' => $data['dependencia_id'],
                'user_id' => $data['user_id'],
                'latitud' => $data['latitud'] ?? null,
                'longitud' => $data['longitud'] ?? null,
                'revisada' => true,
                'incluir_parte' => $data['incluir_parte'] ?? false,
            ]);

            // Eliminar delitos existentes y crear los nuevos
            $novedad->delitos()->delete();
            if (!empty($data['delitos'])) {
                foreach ($data['delitos'] as $delito) {
                    $novedad->delitos()->create([
                        'tipificacion_delito_id' => $delito['tipificacion_id'],
                        'modus_operandi_id' => $delito['modus_operandi_id'] ?? null,
                        'calificacion_id' => $delito['calificacion_id'] ?? null,
                    ]);
                }
            }

            // 🧨 Esto estaba muy abajo: debe ir primero
            if ($siniestro = $novedad->siniestro) {
                $novedad->update(['siniestro_id' => null]); // rompe la FK
                $siniestro->participantes()->delete();
                $siniestro->delete();
            }

            // ✅ Ahora sí podés borrar y volver a crear personas, vehículos y elementos
            $novedad->personas()->delete();
            
            $personas = [];
            if (!empty($data['personas'])) {
                foreach ($data['personas'] as $index => $personaData) {
                    $persona = $novedad->personas()->create([
                        'persona_id' => $personaData['persona_id'],
                        'rol_persona_id' => $personaData['rol_persona_id'],
                        'detalles_adicionales' => $personaData['detalles_adicionales'] ?? null,
                    ]);
                    $personas[$index] = $persona;
                }
            }

            $novedad->vehiculos()->delete();
            $vehiculos = [];
            if (!empty($data['vehiculos'])) {
                foreach ($data['vehiculos'] as $index => $vehiculoData) {
                    $vehiculo = $novedad->vehiculos()->create([
                        'vehiculo_id' => $vehiculoData['vehiculo_id'],
                    ]);
                    $vehiculos[$index] = $vehiculo;
                }
            }

            $novedad->elementos()->delete();
            if (!empty($data['elementos'])) {
                foreach ($data['elementos'] as $elementoData) {
                    $novedad->elementos()->create([
                        'estado_elemento_id' => $elementoData['estado_elemento_id'],
                        'categoria_elemento_id' => $elementoData['categoria_elemento_id'],
                        'cantidad' => $elementoData['cantidad'],
                        'valor' => $elementoData['valor'] ?? 1.0,
                        'detalles' => $elementoData['detalles'] ?? null,
                    ]);
                }
            }

            // ✅ Recrear siniestro (si hay)
            if (!empty($data['siniestro'])) {
                $siniestroData = $data['siniestro'];

                $siniestro = $novedad->siniestro()->create([
                    'tipo_siniestro_id' => $siniestroData['tipo_siniestro_id'],
                    'fuga' => $siniestroData['fuga'] ?? false,
                    'alcohol' => $siniestroData['alcohol'] ?? false,
                    'descripcion' => $siniestroData['descripcion'] ?? null,
                ]);

                foreach ($siniestroData['participantes'] as $p) {
                    $personaNovedadId = null;
                    $vehiculoNovedadId = null;
                    
                    // Encontrar la persona_novedad asociada con la persona_id
                    foreach ($personas as $personaNovedad) {
                        if ($personaNovedad->persona_id == $p['persona_id']) {
                            $personaNovedadId = $personaNovedad->id;
                            break;
                        }
                    }
                    
                    // Encontrar el vehiculo_novedad asociado con el vehiculo_id si existe
                    if (!empty($p['vehiculo_id'])) {
                        foreach ($vehiculos as $vehiculoNovedad) {
                            if ($vehiculoNovedad->vehiculo_id == $p['vehiculo_id']) {
                                $vehiculoNovedadId = $vehiculoNovedad->id;
                                break;
                            }
                        }
                    }
                    
                    $siniestro->participantes()->create([
                        'persona_novedad_id' => $personaNovedadId,
                        'vehiculo_novedad_id' => $vehiculoNovedadId,
                        'rol_siniestro_id' => $p['rol_siniestro_id'],
                    ]);
                }
            }

            // Multimedia
            $novedad->multimedias()->delete();
            if ($request->hasFile('multimedia')) {
                foreach ($request->file('multimedia') as $archivo) {
                    $path = $archivo->store('multimedia', 'public');
                    $novedad->multimedias()->create([
                        'ruta' => $path,
                        'tipo' => $archivo->getMimeType(),
                    ]);
                }
            }

            $fullNovedad = $novedad->load(Novedad::RELACIONES_COMPLETAS);

            HistorialNovedad::create([
                'novedad_id' => $novedad->id,
                'contenido' => json_encode($fullNovedad->toArray()),
                'usuario_revision_id' => auth("web")->id(),
                'accion' => HistorialNovedad::ACCION_MODIFICACION,
            ]);

            return response()->json($fullNovedad, 200);
        });
    }


    public function destroy(Novedad $novedad)
    {
        $novedad->delitos()->delete();
        $novedad->personas()->delete();
        $novedad->vehiculos()->delete();
        $novedad->elementos()->delete();
        $novedad->siniestro()?->participantes()->delete();
        $novedad->siniestro()?->delete();
        $novedad->delete();

        return response()->json(null, 204);
    }

    /**
     * Cambia el estado del campo incluir_parte de una novedad
     *
     * @param Request $request
     * @param Novedad $novedad
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleIncluirParte(Request $request, Novedad $novedad)
    {
        $request->validate([
            'incluir_parte' => 'required|boolean'
        ]);

        $novedad->update([
            'incluir_parte' => $request->boolean('incluir_parte')
        ]);

        // Cargar las relaciones completas para la respuesta
        $novedad->load(Novedad::RELACIONES_COMPLETAS);

        // Crear registro en el historial
      /*   HistorialNovedad::create([
            'novedad_id' => $novedad->id,
            'contenido' => json_encode($novedad->toArray()),
            'usuario_revision_id' => auth("web")->id(),
            'accion' => $request->boolean('incluir_parte') ? HistorialNovedad::ACCION_INCLUIR_PARTE : HistorialNovedad::ACCION_EXCLUIR_PARTE,
        ]); */

        return response()->json($novedad, 200);
    }
}
