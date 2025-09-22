<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoNovedad\TipoNovedadStoreRequest;
use App\Http\Requests\TipoNovedad\TipoNovedadUpdateRequest;
use App\Models\TipoNovedad;
use Illuminate\Http\Request;

class TipoNovedadController extends Controller
{
    public function index(Request $request)
    {
        $query = TipoNovedad::query();
        $query->orderByDesc('created_at');
        $query->with(['tipoAlerta']);

        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        if ($request->boolean('all')) {
            return $query->get();
        }


        return $query->paginate($request->get('per_page', 10));
    }


    public function store(TipoNovedadStoreRequest $request)
    {
        $tipo_novedad = TipoNovedad::create($request->validated());
        return response()->json($tipo_novedad, 201);
    }

    public function show(TipoNovedad $tipo_novedad)
    {
        return $tipo_novedad;
    }


    public function update(TipoNovedadUpdateRequest $request, TipoNovedad $tipo_novedad)
    {
        $tipo_novedad->update($request->validate([
            'nombre' => 'required|string|max:255'
        ]));

        return response()->json($tipo_novedad, 200);
    }

    public function destroy($id)
    {
        $tipo_novedad = TipoNovedad::findOrFail($id);

        if ($tipo_novedad->novedades()->exists()) {
            return response()->json(['message' => 'No se puede eliminar el tipo de novedad porque tiene novedades asociadas.'], 422);
        }

        $tipo_novedad->delete();
        return response()->json(null, 204);
    }
}
