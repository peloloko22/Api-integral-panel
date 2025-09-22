<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoSuicidio;
use Illuminate\Http\Request;
use App\Http\Requests\TipoSuicidio as RequestsTipoSuicidio;

class TipoSuicidioController extends Controller
{
    public function index()
    {
        $query = TipoSuicidio::query();
        $query->orderByDesc('created_at');
        return response()->json($query->get());
    }

    public function store(RequestsTipoSuicidio $request)
    {
        $tipoSuicidio = TipoSuicidio::create($request->validated());
        return response()->json($tipoSuicidio, 201);
    }

    public function show(TipoSuicidio $tipo_suicidio)
    {
        return response()->json($tipo_suicidio);
    }

    public function update(RequestsTipoSuicidio $request, TipoSuicidio $tipo_suicidio)
    {
        $tipo_suicidio->update($request->validated());
        return response()->json($tipo_suicidio);
    }

    public function destroy(TipoSuicidio $tipo_suicidio)
    {
        $tipo_suicidio->delete();
        return response()->json(null, 204);
    }
}
