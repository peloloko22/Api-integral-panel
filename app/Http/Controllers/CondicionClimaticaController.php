<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CondicionClimatica as RequestsCondicionClimatica;
use App\Models\CondicionClimatica;

class CondicionClimaticaController extends Controller
{
    public function index()
    {
        $query = CondicionClimatica::query();
        $query->orderByDesc('created_at');

        return response()->json($query->get());
    }

    public function store(RequestsCondicionClimatica $request)
    {
        $condicionClimatica = CondicionClimatica::create($request->validated());
        return response()->json($condicionClimatica, 201);
    }
    public function update(RequestsCondicionClimatica $request, CondicionClimatica $condicion_climatica)
    {
        $condicion_climatica->update($request->validated());
        return response()->json($condicion_climatica, 200);
    }

    public function destroy(CondicionClimatica $condicion_climatica)
    {
        $condicion_climatica->delete();
        return response()->json(null, 204);
    }

}
