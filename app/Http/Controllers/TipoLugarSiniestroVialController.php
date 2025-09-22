<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoLugarSiniestroVial as RequestsTipoLugarSiniestroVial;
use App\Models\TipoLugarSiniestroVial;
use Illuminate\Http\Request;

class TipoLugarSiniestroVialController extends Controller
{
    public function index()
    {
        $query = TipoLugarSiniestroVial::query();
        $query->orderByDesc('created_at');
        return response()->json($query->get());
    }

    public function store(RequestsTipoLugarSiniestroVial $request)
    {
        $tipoLugarSiniestroVial = TipoLugarSiniestroVial::create($request->validated());
        return response()->json($tipoLugarSiniestroVial, 201);
    }
    
    
    public function destroy(TipoLugarSiniestroVial $tipoLugarSiniestroVial)
    {
    $tipoLugarSiniestroVial->delete();
    return response()->json(null, 204);
    }    


}
