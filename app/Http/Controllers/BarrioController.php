<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Barrio\BarrioUpdateRequest;
use App\Http\Requests\Barrio\BarrioStoreRequest;
use App\Models\Barrio;
use Illuminate\Http\Request;

class BarrioController extends Controller
{
    public function index(Request $request)
    {
        $query = Barrio::query();

        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->input('search') . '%');
        }
        $query->orderByDesc('created_at');

        if ($request->has('localidad_id')) {
            $query->where('localidad_id', $request->input('localidad_id'));
        }

        if ($request->has('codigo')) {
            $query->where('codigo', 'like', '%' . $request->input('codigo') . '%');
        }

        $query->with(['localidad']);

        if ($request->boolean('all')) {
            return $query->get();
        }

        return $query->paginate($request->get('per_page', 10));
    }

    public function show(Barrio $barrio)
    {
        return $barrio->load(['localidad']);
    }

    public function store(BarrioStoreRequest $request)
    {
        $barrio = Barrio::create($request->validated());
        return response()->json($barrio, 201);
    }

    public function update(BarrioUpdateRequest $request, Barrio $barrio)
    {
        $barrio->update($request->validated());
        return response()->json($barrio, 200);
    }

    public function destroy($id)
    {
        $barrio = Barrio::findOrFail($id);

        if ($barrio->novedades()->exists()) {
            return response()->json(['message' => 'El barrio tiene novedades asociadas y no puede ser eliminado.'], 400);
        }

        $barrio->delete();
        return response()->json(null, 204);
    }
}
