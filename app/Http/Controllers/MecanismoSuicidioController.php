<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MecanismoSuicidio;
use App\Http\Requests\MecanismoSuicidio as RequestMecanismoSuicidio;

class MecanismoSuicidioController extends Controller
{
    public function index()
    {   
        $query = MecanismoSuicidio::query();
        $query->orderByDesc('created_at');

        return response()->json($query->get());
    }

    public function store(RequestMecanismoSuicidio $request)
    {
        $mecanismoSuicidio = MecanismoSuicidio::create($request->validated());
        return response()->json($mecanismoSuicidio, 201);
    }

    public function destroy(MecanismoSuicidio $mecanismo_suicidio)
    {
        $mecanismo_suicidio->delete();
        return response()->json(null, 204);
    }

}
