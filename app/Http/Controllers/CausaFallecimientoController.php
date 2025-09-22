<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CausaFallecimientos\CausaFallecimientosStoreRequest;
use App\Http\Requests\CausaFallecimientos\CausaFallecimientosUpdateRequest;

use App\Models\CausaFallecimiento;

class CausaFallecimientoController extends Controller
{
    public function index()
    {

        $query = CausaFallecimiento::query();

        $query->orderByDesc('created_at');

        $tiposSiniestro = $query->get();
        return response()->json($tiposSiniestro);
    }

    public function show($id)
    {
        $tipoSiniestro = CausaFallecimiento::findOrFail($id);
        return response()->json($tipoSiniestro);
    }

    public function store(CausaFallecimientosStoreRequest $request)
    {
        $tipoSiniestro = CausaFallecimiento::create($request->validated());
        return response()->json($tipoSiniestro, 201);
    }

    public function update(CausaFallecimientosUpdateRequest $request, $id)
    {
        $tipoSiniestro = CausaFallecimiento::findOrFail($id);
        $tipoSiniestro->update($request->validated());
        return response()->json($tipoSiniestro);
    }

    public function destroy($id)
    {
        $tipoSiniestro = CausaFallecimiento::findOrFail($id);
        $tipoSiniestro->delete();
        return response()->json(null, 204);
    }
}
