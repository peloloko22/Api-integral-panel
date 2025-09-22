<?php

namespace App\Http\Controllers;

use App\Models\NivelInstruccion;
use App\Http\Controllers\Controller;
use App\Http\Requests\NivelInstruccionPersona;
use Illuminate\Http\Request;

class NivelInstruccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = NivelInstruccion::query();
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
    public function store(NivelInstruccionPersona $request)
    {
        $nivelInstruccion = NivelInstruccion::create($request->validated());
        return response()->json($nivelInstruccion, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(NivelInstruccionPersona $nivel_instruccion)
    {
        return response()->json($nivel_instruccion);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(NivelInstruccionPersona $request, NivelInstruccion $nivel_instruccion)
    {
        $nivel_instruccion->update($request->validated());
        return response()->json($nivel_instruccion);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NivelInstruccion $nivel_instruccion)
    {
        $nivel_instruccion->delete();
        return response()->json(null, 204);
    }
}
