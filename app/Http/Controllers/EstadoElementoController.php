<?php

namespace App\Http\Controllers;

use App\Models\EstadoElemento;
use App\Http\Controllers\Controller;
use App\Http\Requests\EstadoElemento as RequestsEstadoElemento;
use Illuminate\Http\Request;

class EstadoElementoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = EstadoElemento::query();
        $query->orderByDesc('created_at');

        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        if ($request->has('codigo_snic')) {
            $query->where('codigo_snic', 'like', '%' . $request->codigo_snic . '%');
        }

        if ($request->has('codigo_sat')) {
            $query->where('codigo_sat', 'like', '%' . $request->codigo_sat . '%');
        }

        if ($request->boolean('all')) {
            return $query->get();
        }

        return $query->paginate($request->get('per_page', 10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestsEstadoElemento $request)
    {
        $estadoElemento = EstadoElemento::create($request->validated());

        return response()->json($estadoElemento, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(EstadoElemento $estado_elemento)
    {
        return response()->json($estado_elemento);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RequestsEstadoElemento $request, EstadoElemento $estado_elemento)
    {
        $estado_elemento->update($request->validated());
        return response()->json($estado_elemento);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EstadoElemento $estado_elemento)
    {
        $estado_elemento->delete();
        return response()->json(null, 204);
    }
}
