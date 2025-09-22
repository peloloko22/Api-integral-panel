<?php

namespace App\Http\Controllers;

use App\Models\Personas;
use App\Http\Controllers\Controller;
use App\Http\Requests\Persona;
use Illuminate\Http\Request;

class PersonasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Personas::query();
        $query->orderBy('created_at', 'desc')->orderBy('id', 'desc');

        if ($request->has('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        if ($request->has('apellido')) {
            $query->where('apellido', 'like', '%' . $request->apellido . '%');
        }
        if ($request->has('dni')) {
            $query->where('dni', 'like', '%' . $request->dni . '%');
        }
        if ($request->has('telefono')) {
            $query->where('telefono', 'like', '%' . $request->telefono . '%');
        }

        if ($request->has('tipo_persona_id')) {
            $query->where('tipo_persona_id', $request->tipo_persona_id);
        }

        if ($request->has('genero_id')) {
            $query->where('genero_id', $request->genero_id);
        }

        if ($request->has('nacionalidad_id')) {
            $query->where('nacionalidad_id', $request->nacionalidad_id);
        }

        if ($request->has('sexo_id')) {
            $query->where('sexo_id', $request->sexo_id);
        }

        if ($request->has('condicion_persona_id')) {
            $query->where('condicion_persona_id', $request->condicion_persona_id);
        }

        if ($request->has('ocupacion_id')) {
            $query->where('ocupacion_id', $request->ocupacion_id);
        }
        if ($request->has('nivel_instruccion_id')) {
            $query->where('nivel_instruccion_id', $request->nivel_instruccion_id);
        }

        if ($request->has('fecha_nacimiento')) {
            $query->whereDate('fecha_nacimiento', $request->fecha_nacimiento);
        }

        if ($request->has('domicilio')) {
            $query->where('domicilio', 'like', '%' . $request->domicilio . '%');
        }

        if ($request->has('no_identificable')) {
            $query->where('no_identificable', $request->no_identificable);
        } else {
            $query->where('no_identificable', false);
        }

        if ($request->boolean('all')) {
            return $query->get();
        }

        return $query->paginate($request->get('per_page', 10));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Persona $request)
    {
        $persona = Personas::create($request->validated());
        return response()->json($persona, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Personas $personas)
    {
        $id = $personas->id;
        $personaFull = Personas::with(Personas::RELACIONES_COMPLETAS)->findOrFail($id);
        return response()->json($personaFull);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Personas $personas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Persona $request, Personas $personas)
    {
        $personas->update($request->validated());
        return response()->json($personas);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Personas $personas)
    {
        $personas->delete();
        return response()->json(null, 204);
    }
}
