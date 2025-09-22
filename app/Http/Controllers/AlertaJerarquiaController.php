<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AlertaJerarquia\AlertaJerarquiaStoreRequest;
use App\Http\Requests\AlertaJerarquia\AlertaJerarquiaUpdateRequest;
use App\Http\Requests\AlertaJerarquia\AlertaJerarquiUpdateRequest;
use App\Models\AlertaJerarquia;
use App\Models\Jerarquia;
use App\Models\TipoAlerta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AlertaJerarquiaController extends Controller
{
    public function indexJerarquiaAlertas()
    {
        $tiposAlertas = TipoAlerta::all(['id', 'nombre']);

        $jerarquias = Jerarquia::with('tiposAlerta')->get();

        $respuesta = $jerarquias->map(function ($jerarquia) use ($tiposAlertas) {
            return [
                'jerarquia_id' => $jerarquia->id,
                'jerarquia_nombre' => $jerarquia->nombre,
                'tipos_alerta' => $tiposAlertas->map(function ($alerta) use ($jerarquia) {
                    return [
                        'id' => $alerta->id,
                        'nombre' => $alerta->nombre,
                        'activo' => $jerarquia->tiposAlerta->contains('id', $alerta->id),
                    ];
                }),
            ];
        });

        return response()->json($respuesta);
    }

    public function index(Request $request)
    {
        $query = AlertaJerarquia::query();

        if ($request->has("tipo_alerta_id")) {
            $query->where('tipo_alerta_id', $request->input('tipo_alerta_id'));
        }

        $query->with(['jerarquia']);

        $query->orderByDesc('created_at');
        $tipos = $query->get();
        return response()->json($tipos);
    }

    public function show(AlertaJerarquia $alerta_jerarquia)
    {
        return response()->json($alerta_jerarquia);
    }

    public function store(AlertaJerarquiaStoreRequest $request)
    {
        $data = $request->validated();

        $alertaJerarquia = AlertaJerarquia::create($data);

        return response()->json($alertaJerarquia, 201);
    }

     public function update(AlertaJerarquiaStoreRequest $request, AlertaJerarquia $alerta_jerarquia)
    {
        $data = $request->validated();

        $alerta_jerarquia->update($data);

        return response()->json($alerta_jerarquia, 200);
    } 

    public function massUpdate(AlertaJerarquiaUpdateRequest $request)
    {
        $request->validated();

        DB::transaction(function () use ($request) {
            $now = now();
            $datos = [];

            // Borramos todo el contenido de la tabla
            DB::table('alerta_jerarquias')->delete();

            // Preparamos los datos para insertar
            foreach ($request->input('alertas_por_jerarquia', []) as $alertaJerarquia) {
                $datos[] = [
                    'jerarquia_id' => $alertaJerarquia['jerarquia_id'],
                    'tipo_alerta_id' => $alertaJerarquia['alerta_id'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            if (!empty($datos)) {
                DB::table('alerta_jerarquias')->insert($datos);
            }
        });

        return response()->json(['message' => 'Alertas por jerarquía actualizadas correctamente.']);
    }




    public function destroy(AlertaJerarquia $alerta_jerarquia)
    {
        $alerta_jerarquia->delete();

        return response()->json(null, 204);
    }
}
