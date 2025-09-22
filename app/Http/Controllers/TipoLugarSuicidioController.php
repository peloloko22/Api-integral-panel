<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoLugarSuicidio as RequestsTipoLugarSuicidio;
use App\Models\TipoLugarSuicidio;
use Illuminate\Http\Request;

class TipoLugarSuicidioController extends Controller
{
    public function index(Request $request)
    {
        $query = TipoLugarSuicidio::query();
        $query->orderByDesc('created_at');
        return response()->json($query->get());
    }

    public function store(RequestsTipoLugarSuicidio $request)
    {
        $tipoLugarSuicidio = TipoLugarSuicidio::create($request->validated());
        return response()->json($tipoLugarSuicidio, 201);
    }

    public function destroy(TipoLugarSuicidio $tipo_lugar_suicidio)
    {
        $tipo_lugar_suicidio->delete();
        return response()->json(null, 204);
    }

}
