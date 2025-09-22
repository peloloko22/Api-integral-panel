<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoInformacionSumaria;
use Illuminate\Http\Request;
use App\Http\Requests\TipoInformacionSumaria as RequestsTipoInformacionSumaria;

class TipoInformacionSumariaController extends Controller
{
    public function index()
    {
        $query = TipoInformacionSumaria::query();
        $query->orderByDesc('created_at');
        $tipos = $query->get();
        return response()->json($tipos);
    }

    public function show(TipoInformacionSumaria $tipo_informacion_sumaria)
    {
        return response()->json($tipo_informacion_sumaria);
    }

    public function store(RequestsTipoInformacionSumaria $request)
    {
        $tipo_informacion_sumaria = TipoInformacionSumaria::create($request->validated());
        return response()->json($tipo_informacion_sumaria, 201);
    }
    
    public function update(Request $request, TipoInformacionSumaria $tipo_informacion_sumaria)
    {
        $tipo_informacion_sumaria->update($request->validated());
        return response()->json($tipo_informacion_sumaria);
    }


    public function destroy(TipoInformacionSumaria $tipo_informacion_sumaria)
    {
        $tipo_informacion_sumaria->delete();
        return response()->json(null, 204);
    }
}
