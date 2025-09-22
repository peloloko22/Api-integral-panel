<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provincia\ProvinciaStoreRequest;
use App\Http\Requests\Provincia\ProvinciaUpdateRequest;
use App\Models\Provincia;
use Illuminate\Http\Request;

class ProvinciaController extends Controller
{
    public function index(Request $request)
    {
        $query = Provincia::query();
        $query->orderByDesc('created_at');

        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        if ($request->has('codigo')) {
            $query->where('codigo', 'like', '%' . $request->codigo . '%');
        }

        if ($request->boolean('all')) {
            return $query->get();
        }

        return $query->paginate($request->get('per_page', 10));
    }

    public function show(Provincia $provincia)
    {
        return $provincia;
    }

    public function store(ProvinciaStoreRequest $request)
    {
        $provincia = Provincia::create($request->validated());
        return response()->json($provincia, 201);
    }

    public function update(ProvinciaUpdateRequest $request, Provincia $provincia)
    {
        $provincia->update($request->validated());
        return response()->json($provincia, 200);
    }

    public function destroy($id)
    {
        $provincia = Provincia::findOrFail($id);

        // Check if the province is associated with any localities
        if ($provincia->departamentos()->count() > 0) {
            return response()->json(['message' => 'No es posible eliminar la provincia porque tiene departamentos asociados.'], 422);
        }
        $provincia->delete();
        return response()->json(null, 204);
    }
}
