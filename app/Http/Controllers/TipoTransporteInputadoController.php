<?php

namespace App\Http\Controllers;

use App\Models\TipoTransporteInputado;
use App\Http\Controllers\Controller;
use App\Http\Requests\TipoTransporteImputado;
use Illuminate\Http\Request;

class TipoTransporteInputadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TipoTransporteInputado::query();
        $query->orderByDesc('created_at');

        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        if ($request->boolean('all')) {
            return $query->get();
        }

        return response()->json($query->paginate(10));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(TipoTransporteImputado $request)
    {
        $tipoTransporteInputado = TipoTransporteInputado::create($request->validated());
        return response()->json($tipoTransporteInputado, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoTransporteInputado $tipo_transporte_imputados)
    {
        return response()->json($tipo_transporte_imputados);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TipoTransporteImputado $request, TipoTransporteInputado $tipo_transporte_imputados)
    {
        $tipo_transporte_imputados->update($request->validated());
        return response()->json($tipo_transporte_imputados);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoTransporteInputado $tipo_transporte_imputados)
    {
        $tipo_transporte_imputados->delete();
        return response()->json(null, 204);
    }
}
