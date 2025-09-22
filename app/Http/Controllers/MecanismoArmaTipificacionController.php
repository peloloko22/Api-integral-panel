<?php

namespace App\Http\Controllers;

use App\Models\MecanismoArmaTipificacion;
use App\Http\Controllers\Controller;
use App\Http\Requests\MecanismoArmaTipificacion as RequestsMecanismoArmaTipificacion;
use App\Models\TipificacionDelito;
use Illuminate\Http\Request;

class MecanismoArmaTipificacionController extends Controller
{
  
    
    /**
     * Update the specified resource in storage.
     */
    public function update(RequestsMecanismoArmaTipificacion $request, TipificacionDelito $tipificacion_delito)
    {
        $data = $request->validated();
        if (isset($data['mecanismo_arma_ids'])) {
            $tipificacion_delito->mecanismoArmas()->sync($data['mecanismo_arma_ids']);
        }
        return response()->json($tipificacion_delito, 201);
    }

   
    
}
