<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Localidad\LocalidadStoreRequest;
use App\Http\Requests\Localidad\LocalidadUpdateRequest;
use App\Models\Localidad;
use Illuminate\Http\Request;

class LocalidadController extends Controller
{
    public function index(Request $request)
    {
        $query = Localidad::query();
        $query->orderByDesc('created_at');

        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->input('search') . '%');
        }

        if ($request->has('municipio_id')) {
            $query->where('municipio_id', $request->input('municipio_id'));
        }

        if ($request->has('codigo')) {
            $query->where('codigo', 'like', '%' . $request->input('codigo') . '%');
        }

        $query->with(['municipio', 'departamento']);

        if ($request->boolean('all')) {
            return $query->get();
        }

        return $query->paginate($request->get('per_page', 10));
    }

    public function show(Localidad $localidad)
    {
        return $localidad->load(['municipio']);
    }

    public function store(LocalidadStoreRequest $request)
    {
        $localidad = Localidad::create($request->validated());
        return response()->json($localidad, 201);
    }

    public function update(LocalidadUpdateRequest $request, Localidad $localidad)
    {
        $localidad->update($request->validated());
        return response()->json($localidad, 200);
    }

    public function destroy($id)
    {

        $localidad = Localidad::findOrFail($id);
        if ($localidad->barrios()->exists()) {
            return response()->json(['message' => 'No se puede eliminar la localidad porque tiene barrios asociados.'], 422);
        }
        $localidad->delete();
        return response()->json(null, 204);
    }
}
