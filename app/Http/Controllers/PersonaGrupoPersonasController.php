<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\GrupoPersonas\GrupoPersonasStoreRequest;
use App\Models\PersonaGrupoPersonas;
use Illuminate\Http\Request;

class PersonaGrupoPersonasController extends Controller
{
    public function index(Request $request)
    {
        $query = PersonaGrupoPersonas::query();
        $query->orderByDesc('created_at');
        return $query->get();

    }

    public function show(PersonaGrupoPersonas $personas_grupo_personas)
    {
        return response()->json($personas_grupo_personas, 200);
    }

    public function store(GrupoPersonasStoreRequest $request)
    {
        $personas_grupo_personas = PersonaGrupoPersonas::create($request->validated());
        return response()->json($personas_grupo_personas, 201);
    }

    public function update(GrupoPersonasStoreRequest $request, PersonaGrupoPersonas $personas_grupo_personas)
    {
        $personas_grupo_personas->update($request->validated());
        return response()->json($personas_grupo_personas, 200);
    }



    public function destroy($id)
    {
        $personas_grupo_personas = PersonaGrupoPersonas::findOrFail($id);


        $personas_grupo_personas->delete();
        return response()->json(null, 204);
    }
}
