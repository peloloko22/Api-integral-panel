<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalificacionHecho as RequestsCalificacionHecho;
use App\Models\CalificacionHecho;
use Illuminate\Http\Request;

class CalificacionHechoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = CalificacionHecho::query();
        $query->orderByDesc('created_at');

        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        if ($request->has('codigo_sat')) {
            $query->where('codigo_sat', 'like', '%' . $request->codigo_sat . '%');
        }

        if ($request->has('codigo_snic')) {
            $query->where('codigo_snic', 'like', '%' . $request->codigo_snic . '%');
        }

        if ($request->boolean('all')) {
            return $query->get();
        }

        return $query->paginate($request->get('per_page', 10));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestsCalificacionHecho $request)
    {
        $calificacionHecho = CalificacionHecho::create($request->validated());

        return response()->json($calificacionHecho, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CalificacionHecho $calificacion)
    {
        return response()->json($calificacion);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RequestsCalificacionHecho $request, CalificacionHecho $calificacion)
    {
        $calificacion->update($request->validated());

        return response()->json($calificacion);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CalificacionHecho $calificacion)
    {
        $calificacion->delete();
        return response()->json(null, 204);
    }
}
