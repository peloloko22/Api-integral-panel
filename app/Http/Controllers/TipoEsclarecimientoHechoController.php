<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoEsclarecimiento;
use App\Models\TipoEsclarecimientoHecho;
use Illuminate\Http\Request;

class TipoEsclarecimientoHechoController extends Controller
{
    public function index()
    {
        $tipos = TipoEsclarecimientoHecho::all();
        return response()->json($tipos);
    }

    public function store(TipoEsclarecimiento $request)
    {
        $tipo = TipoEsclarecimientoHecho::create($request->validated());
        return response()->json($tipo, 201);
    }

    public function show(TipoEsclarecimientoHecho $tipo)
    {
        return response()->json($tipo);
    }
}
