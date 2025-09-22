<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TipoAlertaGrupoPersona\TipoAlertaGrupoPersonaStoreRequest;
use App\Models\TipoAlertaGrupoPersonas;

class TipoAlertaGrupoPersonasController extends Controller
{
    public function index(Request $request)
    {
        $query = TipoAlertaGrupoPersonas::query();
        $query->orderByDesc('created_at');
        return $query->get();

    }

    public function show(TipoAlertaGrupoPersonas $tipo_alerta_grupo_personas)
    {
        return response()->json($tipo_alerta_grupo_personas, 200);
    }

    public function store(TipoAlertaGrupoPersonaStoreRequest $request)
    {
        $tipo_alerta_grupo_personas = TipoAlertaGrupoPersonas::create($request->validated());
        return response()->json($tipo_alerta_grupo_personas, 201);
    }

    public function update(TipoAlertaGrupoPersonaStoreRequest $request, TipoAlertaGrupoPersonas $tipo_alerta_grupo_personas)
    {
        $tipo_alerta_grupo_personas->update($request->validated());
        return response()->json($tipo_alerta_grupo_personas, 200);
    }



    public function destroy($id)
    {
        $tipo_alerta_grupo_personas = TipoAlertaGrupoPersonas::findOrFail($id);


        $tipo_alerta_grupo_personas->delete();
        return response()->json(null, 204);
    }
}
