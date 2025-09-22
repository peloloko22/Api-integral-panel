<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Alerta\AlertaStoreRequest;
use App\Jobs\EnviarAlertaLoteUsers;
use App\Models\Alerta;
use App\Models\TipoAlerta;
use App\Models\User;
use App\Models\UserSub;
use Illuminate\Http\Request;
use App\Services\Auth\AuthenticatedUserService;

class AlertaController extends Controller
{
    public function index(Request $request)
    {

        $query = Alerta::query();
        $query->orderByDesc('created_at');

        if ($request->has('tipo_alerta_id')) {
            $query->where('tipo_alerta_id', $request->input('tipo_alerta_id'));
        }

        if ($request->has('novedad_id')) {
            $query->where('novedad_id', $request->input('novedad_id'));
        }

        if ($request->has('enviada')) {
            $query->where('enviada', $request->input('enviada'));
        }

        if ($request->has(['fecha_hora_envio_inicio', 'fecha_hora_envio_fin'])) {
            $query->whereBetween('fecha_hora_envio', [
                $request->input('fecha_hora_envio_inicio'),
                $request->input('fecha_hora_envio_fin')
            ]);
        }

        if ($request->has('titulo')) {
            $query->where('titulo', 'like', '%' . $request->input('titulo') . '%');
        }
        $query->with(['tipoAlerta', "novedad"]);

        if ($request->boolean('all')) {
            return $query->get();
        }


        return $query->paginate($request->get('per_page', 10));
    }

    public function alertasDisponiblesUsuario(Request $request, AuthenticatedUserService $authUserService)
    {
        $fullUser = $authUserService->get($request);
        if (!$fullUser) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        // Obtener los grupos de personas del usuario
        $gruposUsuario = $fullUser->gruposPersonas()->pluck('grupo_personas.id');

        // Obtener los tipos de alerta que corresponden a los grupos del usuario
        $tiposAlertaDisponibles = TipoAlerta::whereHas('gruposPersonas', function ($query) use ($gruposUsuario) {
            $query->whereIn('grupo_personas.id', $gruposUsuario);
        })->pluck('id');

        // Construir query de alertas
        $query = Alerta::query();

        // Filtrar por tipos de alerta disponibles para el usuario
        $query->whereIn('tipo_alerta_id', $tiposAlertaDisponibles);

        // Solo alertas enviadas
        $query->where('enviada', true);

        // Ordenar por más recientes
        $query->orderByDesc('fecha_hora_envio');

        // Filtros opcionales
        if ($request->has('fecha_desde')) {
            $query->where('fecha_hora_envio', '>=', $request->input('fecha_desde'));
        }

        if ($request->has('fecha_hasta')) {
            $query->where('fecha_hora_envio', '<=', $request->input('fecha_hasta'));
        }

        if ($request->has('tipo_alerta_id')) {
            $query->where('tipo_alerta_id', $request->input('tipo_alerta_id'));
        }

        if ($request->has('titulo')) {
            $query->where('titulo', 'like', '%' . $request->input('titulo') . '%');
        }

        // Cargar relaciones
        $query->with(['tipoAlerta', 'novedad']);

        // Retornar resultados
        if ($request->boolean('all')) {
            return response()->json($query->get());
        }

        return response()->json($query->paginate($request->get('per_page', 10)));
    }


    public function store(AlertaStoreRequest $request)
    {

        $data = $request->validated();
        $alerta = Alerta::create($data);


        if ($request->input('enviar_ahora')) {
            $tipoAlerta = TipoAlerta::findOrFail($request->tipo_alerta_id);

            dispatch(new EnviarAlertaLoteUsers(
                $tipoAlerta,
                $request->titulo,
                $request->descripcion,
                $alerta->id
            ));
        }
        $alerta->update([
            'enviada' => true,
            'fecha_hora_envio' => now(),
        ]);

        return response()->json($alerta, 201);
    }

    public function show($id)
    {
        $alerta = Alerta::findOrFail($id);

        $alerta->load(['tipoAlerta', 'novedad']);

        return response()->json($alerta);
    }

    public function update(AlertaStoreRequest $request, $id)
    {
        $data = $request->validated();

        $alerta = Alerta::findOrFail($id);
        $alerta->update($data);

        return response()->json($alerta, 200);
    }

    public function destroy($id)
    {
        $alerta = Alerta::findOrFail($id);
        $alerta->delete();

        return response()->json(null, 204);
    }

    public function reenviarAlerta(Alerta $alerta)
    {

        dispatch(new EnviarAlertaLoteUsers(
            $alerta->tipoAlerta,
            $alerta->titulo,
            "{$alerta->descripcion} (Reenviado)",
            $alerta->id
        ));

        $alerta->update([
            'enviada' => true,
            'fecha_hora_envio' => now(),
        ]);

        return response()->json($alerta, 200);
    }
}
