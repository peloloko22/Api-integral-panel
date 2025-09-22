<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sexo\SexoStoreRequest;
use App\Http\Requests\Sexo\SexoUpdateRequest;
use App\Models\Sexos;

class SexosController extends Controller
{
    public function index()
    {
        $query = Sexos::query();
        $query->orderByDesc('created_at');
        $tiposSiniestro = $query->get();
        return response()->json($tiposSiniestro);
    }

    public function show($id)
    {
        $tipoSiniestro = Sexos::findOrFail($id);
        return response()->json($tipoSiniestro);
    }

    public function store(SexoStoreRequest $request)
    {
        $tipoSiniestro = Sexos::create($request->validated());
        return response()->json($tipoSiniestro, 201);
    }

    public function update(SexoUpdateRequest $request, $id)
    {
        $tipoSiniestro = Sexos::findOrFail($id);
        $tipoSiniestro->update($request->validated());
        return response()->json($tipoSiniestro);
    }

    public function destroy($id)
    {
        $tipoSiniestro = Sexos::findOrFail($id);
        $tipoSiniestro->delete();
        return response()->json(null, 204);
    }
}
