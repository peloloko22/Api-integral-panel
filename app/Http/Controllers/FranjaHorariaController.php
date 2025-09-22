<?php

namespace App\Http\Controllers;

use App\Models\FranjaHoraria;
use App\Http\Controllers\Controller;
use App\Http\Requests\FranjaHoraria as RequestsFranjaHoraria;
use Illuminate\Http\Request;

class FranjaHorariaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = FranjaHoraria::query();
        $query->orderByDesc('created_at');


        if ($request->boolean('all')) {
            return $query->get();
        }

        return $query->paginate($request->get('per_page', 10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestsFranjaHoraria $request)
    {
        $franjaHoraria = FranjaHoraria::create($request->validated());
        return response()->json($franjaHoraria, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(FranjaHoraria $franja_horaria)
    {
        return response()->json($franja_horaria);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FranjaHoraria $franja_horaria)
    {
        $franja_horaria->update($request->validated());
        return response()->json($franja_horaria);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FranjaHoraria $franja_horaria)
    {
        $franja_horaria->delete();
        return response()->json(null, 204);
    }
}
