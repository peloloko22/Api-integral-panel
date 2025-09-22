<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SemaforoSiniestro as RequestsSemaforoSiniestro;
use App\Models\SemaforoSiniestro;
use Illuminate\Http\Request;

class SemaforoSiniestroController extends Controller
{
    public function index(Request $request)
    {
        $query = SemaforoSiniestro::query();
        $query->orderByDesc('created_at');
        return response()->json($query->get());
    }

    public function store(RequestsSemaforoSiniestro $request)
    {
        $semaforoSiniestro = SemaforoSiniestro::create($request->validated());
        return response()->json($semaforoSiniestro, 201);
    }
    
    

    public function destroy(SemaforoSiniestro $semaforo_siniestro)
    {
        $semaforo_siniestro->delete();
        return response()->json(null, 204);
    }
}
