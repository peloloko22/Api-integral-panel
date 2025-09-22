<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CapacidadPersona as RequestsCapacidadPersona;
use App\Models\CapacidadPersona;

class CapacidadPersonaController extends Controller
{
    public function index()
    {
        $query = CapacidadPersona::query();
        $query->orderByDesc('created_at');
        return response()->json($query->get());
    }

    public function store(RequestsCapacidadPersona $request)
    {
        $capacidad_persona = CapacidadPersona::create($request->validated());
        return response()->json($capacidad_persona, 201);
    }
    
    public function show(CapacidadPersona $capacidad_persona)
    {
        return response()->json($capacidad_persona);
    }
    
    public function update(RequestsCapacidadPersona $request, CapacidadPersona $capacidad_persona)
    {
        $capacidad_persona->update($request->validated());
        return response()->json($capacidad_persona);
    }
    
    public function destroy(CapacidadPersona $capacidad_persona)
    {
        $capacidad_persona->delete();
        return response()->json(null, 204);
    }
    
}
