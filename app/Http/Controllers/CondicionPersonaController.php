<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Condicion;
use App\Models\CondicionPersona;
use Illuminate\Http\Request;

class CondicionPersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = CondicionPersona::query();
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

        return $query->paginate($request->get('per_page', 10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Condicion $request)
    {
        $condicionPersona = CondicionPersona::create($request->validated());

        return response()->json($condicionPersona, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CondicionPersona $condicion_persona)
    {
        return response()->json($condicion_persona);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Condicion $request, CondicionPersona $condicion_persona)
    {
        $condicion_persona->update($request->validated());

        return response()->json($condicion_persona);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CondicionPersona $condicion_persona)
    {
        $condicion_persona->delete();
        return response()->json(null, 204);
    }
}
