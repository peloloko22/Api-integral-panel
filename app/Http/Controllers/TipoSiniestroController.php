<?php

namespace App\Http\Controllers;

use App\Models\TipoSiniestro;
use App\Http\Controllers\Controller;
use App\Http\Requests\TipoSiniestro as RequestsTipoSiniestro;
use Illuminate\Http\Request;

class TipoSiniestroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TipoSiniestro::query();
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
    public function store(RequestsTipoSiniestro $request)
    {
        $tipoSiniestro = TipoSiniestro::create($request->validated());
        return response()->json($tipoSiniestro, 201);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoSiniestro $tipoSiniestro)
    {
        $tipoSiniestro->delete();
        return response()->json(null, 204);
    }
}
