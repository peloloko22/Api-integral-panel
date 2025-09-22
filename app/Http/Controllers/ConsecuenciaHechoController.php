<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConsecuenciaHecho as RequestsConsecuenciaHecho;
use App\Models\ConsecuenciaHecho;

class ConsecuenciaHechoController extends Controller
{
    public function index()
    {
        $query = ConsecuenciaHecho::query();
        $query->orderByDesc('created_at');
        return response()->json($query->get());
    }

    public function store(RequestsConsecuenciaHecho $request)
    {
        $consecuencia_hecho = ConsecuenciaHecho::create($request->validated());
        return response()->json($consecuencia_hecho, 201);
    }
    
    public function show(ConsecuenciaHecho $consecuencia_hecho)
    {
        return response()->json($consecuencia_hecho);
    }
    
    public function update(ConsecuenciaHecho $request, ConsecuenciaHecho $consecuencia_hecho)
    {
        $consecuencia_hecho->update($request->validated());
        return response()->json($consecuencia_hecho);
    }
    
    public function destroy(ConsecuenciaHecho $consecuencia_hecho)
    {
        $consecuencia_hecho->delete();
        return response()->json(null, 204);
    }
}
