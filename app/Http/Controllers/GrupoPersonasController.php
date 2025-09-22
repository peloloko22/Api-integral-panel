<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\GrupoPersonas\GrupoPersonasStoreRequest;
use App\Models\GrupoPersonas;
use App\Models\PersonaGrupoPersonas;
use Illuminate\Http\Request;

class GrupoPersonasController extends Controller
{
    public function index(Request $request)
    {
        $query = GrupoPersonas::query();
        $query->orderByDesc('created_at');
        $query->with(GrupoPersonas::MODELOS);
        return $query->get();

    }

    public function show(GrupoPersonas $grupo_personas)
    {
        return response()->json($grupo_personas->load(GrupoPersonas::MODELOS), 200);
    }

    public function store(GrupoPersonasStoreRequest $request)
    {
        $grupo_personas = GrupoPersonas::create($request->validated());
        return response()->json($grupo_personas, 201);
    }

    public function update(GrupoPersonasStoreRequest $request, GrupoPersonas $grupo_personas)
    {
        $grupo_personas->update($request->validated());
        return response()->json($grupo_personas, 200);
    }

    public function sincronizarEnMasaPersonas(Request $request, GrupoPersonas $grupo_personas)
    {

        $rules = [
            'ids' => 'nullable|array',
            'ids.*' => 'exists:users,id',
        ];


        $request->validate($rules);

        $ids = $request->input('ids', []);

        $grupo_personas->personas()->sync($ids);

        return response()->json($grupo_personas, 200);
    }

    public function sincronizarEnMasaTipoAlerta(Request $request, GrupoPersonas $grupo_personas)
    {

        $rules = [
            'ids' => 'nullable|array',
            'ids.*' => 'exists:tipo_alertas,id',
        ];

        $request->validate($rules);
        $ids = $request->input('ids', []);
        $grupo_personas->tipoAlertas()->sync($ids);
        return response()->json($grupo_personas, 200);
    }

    public function destroy($id)
    {
        $grupo_personas = GrupoPersonas::findOrFail($id);

        $grupo_personas->delete();
        return response()->json(null, 204);
    }

    public function indexarPersonasTipoAlerta()
    {

        $personas = PersonaGrupoPersonas::query()
            ->select('persona_id', 'tipo_alerta')
            ->whereNotNull('tipo_alerta')
            ->groupBy('persona_id', 'tipo_alerta')
            ->get();

        $index = [];
        foreach ($personas as $persona) {
            $index[$persona->persona_id][] = $persona->tipo_alerta;
        }

        return response()->json($index, 200);
    }

}
