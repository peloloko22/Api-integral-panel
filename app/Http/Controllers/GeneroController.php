<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Genero as RequestsGenero;
use App\Models\Genero;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Genero::query();
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
    public function store(RequestsGenero $request)
    {
        $genero = Genero::create($request->validated());
        return response()->json($genero, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Genero $genero)
    {
        return response()->json($genero);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RequestsGenero $request, Genero $genero)
    {
        $genero->update($request->validated());
        return response()->json($genero);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genero $genero)
    {
        $genero->delete();
        return response()->json(null, 204);
    }
}
