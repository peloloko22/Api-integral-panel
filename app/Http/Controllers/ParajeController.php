<?php

namespace App\Http\Controllers;

use App\Models\Paraje;
use App\Http\Controllers\Controller;
use App\Http\Requests\Paraje as RequestsParaje;
use Illuminate\Http\Request;

class ParajeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Paraje::query();
        $query->orderByDesc('created_at');

        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        if ($request->has('localidad_id')) {
            $query->where('localidad_id', $request->localidad_id);
        }
        if ($request->boolean('all')) {
            return $query->get();/*  */
        }

        return $query->paginate($request->get('per_page', 10));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestsParaje $request)
    {
        $paraje = Paraje::create($request->validated());
        return response()->json($paraje, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Paraje $paraje)
    {
        return response()->json($paraje);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(RequestsParaje $request, Paraje $paraje)
    {
        $paraje->update($request->validated());
        return response()->json($paraje);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paraje $paraje)
    {
        $paraje->delete();
        return response()->json(null, 204);
    }
}
