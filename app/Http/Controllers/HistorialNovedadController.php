<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\HistorialNovedad\HistorialNovedadStoreRequest;
use App\Models\HistorialNovedad;

class HistorialNovedadController extends Controller
{
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(HistorialNovedadStoreRequest $request)
    {
        $validatedData = $request->validated();
        $historial =  HistorialNovedad::create($validatedData);
        return response()->json($historial, 201);
    }

    

}
