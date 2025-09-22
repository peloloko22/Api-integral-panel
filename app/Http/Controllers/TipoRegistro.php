<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoRegistro as RequestsTipoRegistro;
use App\Models\TipoRegistro as ModelsTipoRegistro;
use Illuminate\Http\Request;

class TipoRegistro extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ModelsTipoRegistro::query();
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
    public function store(RequestsTipoRegistro $request)
    {
        $tipoRegistro = ModelsTipoRegistro::create($request->validated());
        return response()->json($tipoRegistro, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoRegistro $tipo_registro)
    {
        return response()->json($tipo_registro);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(RequestsTipoRegistro $request, ModelsTipoRegistro $tipo_registro)
    {
        $tipo_registro->update($request->validated());
        return response()->json($tipo_registro);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModelsTipoRegistro $tipo_registro)
    {
        $tipo_registro->delete();
        return response()->json(null, 204);
    }
}
