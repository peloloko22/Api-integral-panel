<?php

namespace App\Http\Controllers;

use App\Models\ModusOperandiTipificacion;
use App\Http\Controllers\Controller;
use App\Http\Requests\ModusOperandiTipificacion as RequestsModusOperandiTipificacion;
use App\Models\TipificacionDelito;
use Illuminate\Http\Request;

class ModusOperandiTipificacionController extends Controller
{
    
    /**
     * Update the specified resource in storage.
     */
    public function update(RequestsModusOperandiTipificacion $request, TipificacionDelito $tipificacion_delito)
    {
        $data = $request->validated();
        if (isset($data['modus_operandi_ids'])) {
            $tipificacion_delito->modusOperandis()->sync($data['modus_operandi_ids']);
        }
        return response()->json($tipificacion_delito, 201);
    }

  
    
}
