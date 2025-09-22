<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Municipio\MunicipioStoreRequest;
use App\Http\Requests\Municipio\MunicipioUpdateRequest;
use App\Models\Municipio;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    public function index(Request $request)
    {
        $query = Municipio::query();
        $query->orderByDesc('created_at');

        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->input('search') . '%');
        }

        if ($request->has('departamento_id')) {
            $query->where('departamento_id', $request->input('departamento_id'));
        }

        if ($request->has('codigo')) {
            $query->where('codigo', 'like', '%' . $request->input('codigo') . '%');
        }

        $query->with(['departamento']);

        if ($request->boolean('all')) {
            return $query->get();
        }

        return $query->paginate($request->get('per_page', 10));
    }

    public function show(Municipio $municipio)
    {
        return $municipio->load(['departamento']);
    }

    public function store(MunicipioStoreRequest $request)
    {
        $municipio = Municipio::create($request->validated());
        return response()->json($municipio, 201);
    }

    public function update(MunicipioUpdateRequest $request, Municipio $municipio)
    {
        $municipio->update($request->validated());
        return response()->json($municipio, 200);
    }

    public function destroy(Municipio $municipio)
    {
        $municipio->delete();
        return response()->json(null, 204);
    }
}
