<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dependencia\DependenciaStoreRequest;
use App\Http\Requests\Dependencia\DependenciaUpdateRequest;
use App\Models\Dependencia;
use Illuminate\Http\Request;

class DependenciaController extends Controller
{
    public function index(Request $request)
    {
        $query = Dependencia::query();

        $query->orderByDesc('created_at');

        if ($request->has('departamental_id')) {
            $query->where('departamental_id', $request->departamental_id);
        }

        if ($request->has('codigo')) {
            $query->where('codigo', 'like', '%' . $request->codigo . '%');
        }

        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }
        $query->with(['departamental']);

        if ($request->boolean('all')) {
            return $query->get();
        }


        return $query->paginate($request->get('per_page', 10));
    }

    public function show(Dependencia $dependencia)
    {
        return $dependencia->load(['departamental']);
    }


    public function store(DependenciaStoreRequest $request)
    {
        $dependencia = Dependencia::create($request->validated());
        return response()->json($dependencia, 201);
    }

    public function update(DependenciaUpdateRequest $request, Dependencia $dependencia)
    {
        $dependencia->update($request->validated());
        return response()->json($dependencia, 200);
    }

    public function destroy($id)
    {
        $dependencia = Dependencia::findOrFail($id);

        // Verificar si la comisaría tiene funcionarios asociados
        if ($dependencia->novedades()->count() > 0) {
            return response()->json(['message' => 'No se puede eliminar la comisaría porque tiene novedades asociadas.'], 422);
        }

        $dependencia->delete();
        return response()->json(null, 204);
    }
}
