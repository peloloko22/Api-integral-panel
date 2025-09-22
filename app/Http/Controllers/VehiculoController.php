<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vehiculo as RequestsVehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Vehiculo::query();
        $query->orderByDesc('created_at');


        if ($request->has('search')) {
            $query->where('dominio', 'like', '%' . $request->search . '%');
        }
        if ($request->has('tipo_vehiculo_id')) {
            $query->where('tipo_vehiculo_id', $request->tipo_vehiculo_id);
        }
        if ($request->has('marca')) {
            $query->where('marca', 'like', '%' . $request->marca . '%');
        }
        if ($request->has('modelo')) {
            $query->where('modelo', 'like', '%' . $request->modelo . '%');
        }
        if ($request->has('color')) {
            $query->where('color', 'like', '%' . $request->color . '%');
        }
        if ($request->has('numero_motor')) {
            $query->where('numero_motor', 'like', '%' . $request->numero_motor . '%');
        }
        if ($request->has('numero_chasis')) {
            $query->where('numero_chasis', 'like', '%' . $request->numero_chasis . '%');
        }
        if ($request->has('extra')) {
            $query->where('extra', 'like', '%' . $request->extra . '%');
        }

        if($request->has('no_identificable')) {
            $query->where('no_identificable', $request->no_identificable);
        }else{
            $query->where('no_identificable', false);
        }


        if($request->has('tipo_vehiculo_id')) {
            $query->where('tipo_vehiculo_id', $request->tipo_vehiculo_id);
        }

        if ($request->boolean('all')) {
            return $query->get();
        }

        return response()->json($query->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestsVehiculo $request)
    {
        $vehiculo = Vehiculo::create($request->validated());
        return response()->json($vehiculo, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehiculo $vehiculo)
    {
        return response()->json($vehiculo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        $vehiculo->update($request->validated());
        return response()->json($vehiculo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();
        return response()->json(null, 204);
    }
}
