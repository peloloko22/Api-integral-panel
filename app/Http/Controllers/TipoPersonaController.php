<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoPersona as RequestsTipoPersona;
use App\Models\TipoPersona;
use Illuminate\Http\Request;

class TipoPersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TipoPersona::query();
        $query->orderByDesc('created_at');

        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        if ($request->has('codigo_snic')) {
            $query->where('codigo_snic', 'like', '%' . $request->codigo_snic . '%');
        }

        if ($request->has('codigo_sat')) {
            $query->where('codigo_sat', 'like', '%' . $request->codigo_sat . '%');
        }

        if ($request->boolean('all')) {
            return $query->get();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestsTipoPersona $request)
    {
        $tipoPersona = TipoPersona::create($request->validated());
        return response()->json($tipoPersona, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoPersona $tipo_persona)
    {
        return response()->json($tipo_persona);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RequestsTipoPersona $request, TipoPersona $tipo_persona)
    {
        $tipo_persona->update($request->validated());
        return response()->json($tipo_persona);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoPersona $tipo_persona)
    {
        $tipo_persona->delete();
        return response()->json(null, 204);
    }

}
