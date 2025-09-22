<?php

namespace App\Http\Controllers;

use App\Models\Ocupacion;
use App\Http\Controllers\Controller;
use App\Http\Requests\OcupacionPersona;
use Illuminate\Http\Request;

class OcupacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Ocupacion::query();
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
    public function store(OcupacionPersona $request)
    {
        $ocupacion = Ocupacion::create($request->validated());
        return response()->json($ocupacion, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ocupacion $ocupacion)
    {
        return response()->json($ocupacion);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(OcupacionPersona $request, Ocupacion $ocupacion)
    {
        $ocupacion->update($request->validated());
        return response()->json($ocupacion);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ocupacion $ocupacion)
    {
        $ocupacion->delete();
        return response()->json(null, 204);
    }
}
