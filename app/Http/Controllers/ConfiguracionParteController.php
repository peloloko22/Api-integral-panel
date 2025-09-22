<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfiguracionParte\ConfiguracionParteStoreRequest;
use App\Models\ConfiguracionParte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfiguracionParteController extends Controller
{
    public function index(Request $request)
    {
        $request = ConfiguracionParte::first();
        return response()->json($request);
    }

    public function store(ConfiguracionParteStoreRequest $request)
    {
        $configuracion = ConfiguracionParte::create($request->validated());
        
        return response()->json([
            'message' => 'Configuración creada con éxito.',
            'data' => $configuracion
        ], 201);
    }

    public function update(ConfiguracionParteStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            // Borra cualquier configuración anterior
            DB::table('configuracion_partes')->delete();


            // Crea la nueva
            ConfiguracionParte::create($request->validated());
        });

        return response()->json(['message' => 'Configuración actualizada con éxito.']);
    }

    public function destroy($id)
    {
        $configuracion = ConfiguracionParte::find($id);
        
        if (!$configuracion) {
            return response()->json([
                'message' => 'Configuración no encontrada.'
            ], 404);
        }

        $configuracion->delete();

        return response()->json([
            'message' => 'Configuración eliminada con éxito.'
        ]);
    }
}
