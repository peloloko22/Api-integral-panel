<?php

namespace App\Http\Controllers;

use App\Models\TipoZona;
use App\Http\Controllers\Controller;
use App\Http\Requests\TipoZona as RequestsTipoZona;
use Illuminate\Http\Request;

class TipoZonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TipoZona::query();
        $query->orderByDesc('created_at');

        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        if ($request->boolean('all')) {
            return $query->get();
        }

        return response()->json($query->paginate(10));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestsTipoZona $request)
    {
        $tipoZona = TipoZona::create($request->validated());
        return response()->json($tipoZona, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoZona $tipo_zona)
    {
        return response()->json($tipo_zona);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RequestsTipoZona $request, TipoZona $tipo_zona)
    {
        $tipo_zona->update($request->validated());
        return response()->json($tipo_zona);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoZona $tipo_zona)
    {
        $tipo_zona->delete();
        return response()->json(null, 204);
    }
}
