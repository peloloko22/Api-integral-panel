<?php

namespace App\Http\Controllers;

use App\Models\ConocimientoImputado;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConocimientoImputado as RequestsConocimientoImputado;
use Illuminate\Http\Request;

class ConocimientoImputadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ConocimientoImputado::query();
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
    public function store(RequestsConocimientoImputado $request)
    {
        $conocimientoImputado = ConocimientoImputado::create($request->validated());
        return response()->json($conocimientoImputado, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ConocimientoImputado $conocimiento_imputado)
    {
        return response()->json($conocimiento_imputado);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(RequestsConocimientoImputado $request, ConocimientoImputado $conocimiento_imputado)
    {
        $conocimiento_imputado->update($request->validated());
        return response()->json($conocimiento_imputado);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConocimientoImputado $conocimiento_imputado)
    {
        $conocimiento_imputado->delete();
        return response()->json(null, 204);
    }
}
