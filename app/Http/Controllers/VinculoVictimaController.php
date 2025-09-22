<?php

namespace App\Http\Controllers;

use App\Models\VinculoVictima;
use App\Http\Controllers\Controller;
use App\Http\Requests\VinculoVictima as RequestsVinculoVictima;
use Illuminate\Http\Request;

class VinculoVictimaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = VinculoVictima::query();
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
        return response()->json($query->paginate(10));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestsVinculoVictima $request)
    {
        $vinculoVictima = VinculoVictima::create($request->validated());
        return response()->json($vinculoVictima, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(VinculoVictima $vinculo_victima)
    {
        return response()->json($vinculo_victima);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(RequestsVinculoVictima $request, VinculoVictima $vinculo_victima)
    {
        $vinculo_victima->update($request->validated());
        return response()->json($vinculo_victima);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VinculoVictima $vinculo_victima)
    {
        $vinculo_victima->delete();
        return response()->json(null, 204);
    }
}
