<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolPersona;
use App\Models\RolPersona as ModelsRolPersona;

class RolPersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query =  ModelsRolPersona::query();

        $query->orderBy('created_at', 'desc')->orderBy('id', 'desc');

        if (request()->has('nombre')) {
            $query->where('nombre', 'like', '%' . request()->nombre . '%');
        }


        if (request()->boolean('all')) {
            return $query->get();
        }

        return $query->paginate(request()->get('per_page', 10));


    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(RolPersona $request)
    {
        $data = $request->validated();
        $rolPersona = ModelsRolPersona::create($data);
        return response()->json($rolPersona, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ModelsRolPersona $rol_persona)
    {
        return response()->json($rol_persona);
    }

    public function destroy(ModelsRolPersona $rol_persona)
    {
        $rol_persona->vinculoVictima()->detach();
        $rol_persona->conocimientoImputado()->detach();
        $rol_persona->delete();
        return response()->json(null, 204);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModelsRolPersona $rol_persona, RolPersona $request)
    {
        $data = $request->validated();
        $rol_persona->update($data);
        return response()->json($rol_persona, 200);
    }
}
