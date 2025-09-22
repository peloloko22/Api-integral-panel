<?php

namespace App\Http\Controllers;

use App\Models\MecanismoArma;
use App\Http\Controllers\Controller;
use App\Http\Requests\MecanismoArma as RequestsMecanismoArma;
use Illuminate\Http\Request;

class MecanismoArmaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MecanismoArma::query();
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
    public function store(RequestsMecanismoArma $request)
    {
        $mecanismoArma = MecanismoArma::create($request->validated());
        return response()->json($mecanismoArma, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(MecanismoArma $mecanismo_arma)
    {
        return response()->json($mecanismo_arma);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(RequestsMecanismoArma $request, MecanismoArma $mecanismo_arma)
    {
        $mecanismo_arma->update($request->validated());
        return response()->json($mecanismo_arma);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MecanismoArma $mecanismo_arma)
    {
        $mecanismo_arma->delete();
        return response()->json(null, 204);
    }
}
