<?php

namespace App\Http\Controllers;

use App\Models\EstadoPersona;
use App\Http\Controllers\Controller;
use App\Http\Requests\EstadoPersona as RequestsEstadoPersona;
use Illuminate\Http\Request;

class EstadoPersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = EstadoPersona::query();
        $query->orderByDesc('created_at');

        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }



        if ($request->boolean('all')) {
            return $query->get();
        }

        return $query->paginate($request->get('per_page', 10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestsEstadoPersona $request)
    {
        $estadoPersona = EstadoPersona::create($request->validated());

        return response()->json($estadoPersona, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(EstadoPersona $estado_persona)
    {
        return response()->json($estado_persona);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EstadoPersona $estadoPersona)
    {
        $estadoPersona->update($request->validated());
        return response()->json($estadoPersona);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EstadoPersona $estado_persona)
    {
        $estado_persona->delete();
        return response()->json(null, 204);
    }
}
