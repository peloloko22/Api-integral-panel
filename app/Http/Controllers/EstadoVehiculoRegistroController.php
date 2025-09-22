<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EstadoVehiculoRegistro as RequestsEstadoVehiculoRegistro;
use App\Models\EstadoVehiculoRegistro;

class EstadoVehiculoRegistroController extends Controller
{
    public function index()
    {
        $query = EstadoVehiculoRegistro::query();
        $query->orderByDesc('created_at');

        $estado_vehiculoR_rgistros = $query->get();

        return response()->json($estado_vehiculoR_rgistros);
    }

    public function store(RequestsEstadoVehiculoRegistro $request)
    {
        $estado_vehiculo_registro = EstadoVehiculoRegistro::create($request->validated());
        return response()->json($estado_vehiculo_registro, 201);
    }

    public function show(EstadoVehiculoRegistro $estado_vehiculo_registro)
    {
        return response()->json($estado_vehiculo_registro);
    }

    public function update(RequestsEstadoVehiculoRegistro $request, EstadoVehiculoRegistro $estado_vehiculo_registro)
    {
        $estado_vehiculo_registro->update($request->validated());
        return response()->json($estado_vehiculo_registro);
    }

    public function destroy(EstadoVehiculoRegistro $estado_vehiculo_registro)
    {
        $estado_vehiculo_registro->delete();
        return response()->json(null, 204);
    }
}
