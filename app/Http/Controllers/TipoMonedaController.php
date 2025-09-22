<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoMoneda as RequestsTipoMoneda;
use App\Models\TipoMoneda;
use Illuminate\Http\Request;

class TipoMonedaController extends Controller
{
    public function index()
    {
        $query = TipoMoneda::query();
        $query->orderByDesc('created_at');
        return response()->json($query->get());
    }

    public function show(RequestsTipoMoneda $tipo_moneda)
    {	
        return response()->json($tipo_moneda);
    }

    public function store(RequestsTipoMoneda $request)
    {
        $tipo_moneda = TipoMoneda::create($request->validated());
        return response()->json($tipo_moneda, 201);
    }

    public function update(RequestsTipoMoneda $request, TipoMoneda $tipo_moneda)
    {
        $tipo_moneda->update($request->validated());
        return response()->json($tipo_moneda, 200);
    }

    public function destroy(TipoMoneda $tipo_moneda)
    {
        $tipo_moneda->delete();
        return response()->json(null, 204);
    }

}
