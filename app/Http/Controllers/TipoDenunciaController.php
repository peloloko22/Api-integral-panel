<?php

namespace App\Http\Controllers;

use App\Models\TipoDenuncia;
use App\Http\Controllers\Controller;
use App\Http\Requests\TipoDenuncia as RequestsTipoDenuncia;
use Illuminate\Http\Request;

class TipoDenunciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TipoDenuncia::query();
        $query->orderByDesc('created_at');
        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        if ($request->has('all')) {
            return $query->get();
        }

        return $query->paginate($request->get('per_page', 10));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestsTipoDenuncia $request)
    {
        $tipoDenuncia = TipoDenuncia::create($request->validated());
        return response()->json($tipoDenuncia, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoDenuncia $tipo_denuncia)
    {
        return response()->json($tipo_denuncia);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(RequestsTipoDenuncia $request, TipoDenuncia $tipo_denuncia)
    {
        $tipo_denuncia->update($request->validated());
        return response()->json($tipo_denuncia);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoDenuncia $tipo_denuncia)
    {
        $tipo_denuncia->delete();
        return response()->json(null, 204);
    }
}
