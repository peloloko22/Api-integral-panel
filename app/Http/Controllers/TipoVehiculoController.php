<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoVehiculo\TipoVehiculoStoreRequest;
use App\Models\TipoVehiculo;
use Illuminate\Http\Request;

class TipoVehiculoController extends Controller
{
    public function index(Request $request)
    {
        $query = TipoVehiculo::query();
        $query->orderByDesc('created_at');

        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->input('search') . '%');
        }

        if ($request->boolean('all')) {
            return $query->get();
        }

        return $query->paginate($request->get('per_page', 10));
    }

    public function show(TipoVehiculo $tipoVehiculo)
    {
        return $tipoVehiculo;
    }

    public function store(TipoVehiculoStoreRequest $request)
    {
        $tipoVehiculo = TipoVehiculo::create($request->validated());
        return response()->json($tipoVehiculo, 201);
    }

    public function update(TipoVehiculoStoreRequest $request, TipoVehiculo $tipoVehiculo)
    {
        $tipoVehiculo->update($request->validated());
        return response()->json($tipoVehiculo, 200);
    }

    public function destroy(TipoVehiculo $tipoVehiculo)
    {
        $tipoVehiculo->delete();
        return response()->json(null, 204);
    }
}
