<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EstadoCivil as RequestsEstadoCivil;
use App\Models\EstadoCivil;
use Illuminate\Http\Request;

class EstadoCivilController extends Controller
{
    public function index()
    {
        $query = EstadoCivil::query();
        $query->orderByDesc('created_at');
        $estadoCiviles = $query->get();
        return response()->json($estadoCiviles);
    }

    public function show(EstadoCivil $estado_civil)
    {
        return response()->json($estado_civil);
    }

    public function store(RequestsEstadoCivil $request)
    {
        $estadoCivil = EstadoCivil::create($request->validated());
        return response()->json($estadoCivil, 201);
    }
    
    public function update(RequestsEstadoCivil $request, EstadoCivil $estado_civil)
    {
        $estado_civil->update($request->validated());
        return response()->json($estado_civil);
    }
    
    public function destroy(EstadoCivil $estado_civil)
    {
        $estado_civil->delete();
        return response()->json(null, 204);
    }
}
