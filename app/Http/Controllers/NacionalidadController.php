<?php

namespace App\Http\Controllers;

use App\Models\Nacionalidad;
use App\Http\Controllers\Controller;
use App\Http\Requests\Nacionalidad as RequestsNacionalidad;
use Illuminate\Http\Request;

class NacionalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Nacionalidad::query();
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
    public function store(RequestsNacionalidad $request)
    {
        $nacionalidad = Nacionalidad::create($request->validated());
        return response()->json($nacionalidad, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Nacionalidad $nacionalidad)
    {
        return response()->json($nacionalidad);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(RequestsNacionalidad $request, Nacionalidad $nacionalidad)
    {
        $nacionalidad->update($request->validated());
        return response()->json($nacionalidad);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nacionalidad $nacionalidad)
    {
        $nacionalidad->delete();
        return response()->json(null, 204);
    }
}
