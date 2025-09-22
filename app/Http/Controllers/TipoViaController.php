<?php

namespace App\Http\Controllers;

use App\Models\TipoVia;
use App\Http\Controllers\Controller;
use App\Http\Requests\TipoVia as RequestsTipoVia;
use Illuminate\Http\Request;

class TipoViaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TipoVia::query();
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
    public function store(RequestsTipoVia $request)
    {
        $tipoVia = TipoVia::create($request->validated());
        return response()->json($tipoVia, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoVia $tipoVia)
    {
        return response()->json($tipoVia);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(RequestsTipoVia $request, TipoVia $tipo_via)
    {
        $tipo_via->update($request->validated());
        return response()->json($tipo_via);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoVia $tipo_via)
    {
        $tipo_via->delete();
        return response()->json(null, 204);
    }
}
