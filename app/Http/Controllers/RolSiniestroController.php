<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolSiniestro\RolSiniestroStoreRequest;
use App\Http\Requests\RolSiniestro\RolSiniestroUpdateRequest;
use App\Models\RolSiniestro;
use Illuminate\Http\Request;

class RolSiniestroController extends Controller
{
    public function index()
    {
        $query = RolSiniestro::query();
        $query->orderByDesc('created_at');
        $tiposSiniestro = $query->get();
        return response()->json($tiposSiniestro);
    }

    public function show($id)
    {
        $tipoSiniestro = RolSiniestro::findOrFail($id);
        return response()->json($tipoSiniestro);
    }

    public function store(RolSiniestroStoreRequest $request)
    {
        $tipoSiniestro = RolSiniestro::create($request->validated());
        return response()->json($tipoSiniestro, 201);
    }

    public function update(RolSiniestroUpdateRequest $request, $id)
    {
        $tipoSiniestro = RolSiniestro::findOrFail($id);

        $tipoSiniestro->update($request->validated());
        return response()->json($tipoSiniestro);
    }

    public function destroy($id)
    {
        $tipoSiniestro = RolSiniestro::findOrFail($id);

        if ($tipoSiniestro->personas()->exists()) {
            return response()->json(['message' => 'No se puede eliminar el rol de siniestro vial porque hay personas en siniestros que lo utilizan.'], 422);
        }
        $tipoSiniestro->delete();
        return response()->json(null, 204);
    }
}
