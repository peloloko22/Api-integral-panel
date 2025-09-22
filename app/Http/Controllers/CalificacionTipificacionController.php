<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalificacionTipificacion as RequestsCalificacionTipificacion;
use App\Models\TipificacionDelito;

class CalificacionTipificacionController extends Controller
{
    

    /**
     * Update the specified resource in storage.
     */
    public function update(RequestsCalificacionTipificacion $request, TipificacionDelito $tipificacion_delito)
    {
        $data = $request->validated();
        if (isset($data['calificaciones_ids'])) {
            $tipificacion_delito->calificaciones()->sync($data['calificaciones_ids']);
        }
        return response()->json($tipificacion_delito, 201);
    }

    
    
}
