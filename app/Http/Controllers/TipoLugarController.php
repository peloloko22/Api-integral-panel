<?php

namespace App\Http\Controllers;

use App\Models\TipoLugar;
use App\Http\Controllers\Controller;
use App\Http\Requests\TipoLugar as RequestsTipoLugar;
use Illuminate\Http\Request;

class TipoLugarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TipoLugar::query();
        $query->orderByDesc('created_at');

        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        return $query->paginate($request->get('per_page', 10));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestsTipoLugar $request)
    {
        $tipoLugar = TipoLugar::create($request->validated());
        return response()->json($tipoLugar, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoLugar $tipo_lugar)
    {
        return response()->json($tipo_lugar);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(RequestsTipoLugar $request, TipoLugar $tipo_lugar)
    {
        $tipo_lugar->update($request->validated());
        return response()->json($tipo_lugar);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoLugar $tipo_lugar)
    {
        $tipo_lugar->delete();
        return response()->json(null, 204);
    }
}
