<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipificacionDelito\TipificacionDelitoStoreRequest;
use App\Http\Requests\TipificacionDelito\TipificacionDelitoUpdateRequest;
use App\Models\TipificacionDelito;
use Illuminate\Http\Request;

class TipificacionDelitoController extends Controller
{
    public function index(Request $request)
    {
        $query = TipificacionDelito::query();
        $query->orderByDesc('created_at');

        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        if ($request->has('categoria_delito_id')) {
            $query->where('categoria_delito_id', $request->categoria_delito_id);
        }

        if($request->has('homicidio')) {
            $query->where('homicidio', $request->homicidio);
        }

        $query->with(['categoria', 'calificaciones','modusOperandis','mecanismoArmas']);
        
        if ($request->boolean('all')) {
            return $query->get();
        }


        return $query->paginate($request->get('per_page', 10));
    }

    public function show(TipificacionDelito $tipificacion_delito)
    {
        return $tipificacion_delito->load(['categoria', 'calificaciones', 'modusOperandis', 'mecanismoArmas',]);
    }

    public function store(TipificacionDelitoStoreRequest $request)
    {
        $tipificacion_delito = TipificacionDelito::create($request->validated());
        return response()->json($tipificacion_delito, 201);
    }

    public function update(TipificacionDelitoStoreRequest $request, TipificacionDelito $tipificacion_delito)
    {
        $tipificacion_delito->update($request->validated());
        return response()->json($tipificacion_delito, 200);
    }

    public function destroy($id)
    {
        $tipificacion_delito = TipificacionDelito::findOrFail($id);
        if ($tipificacion_delito->novedades()->exists()) {
            return response()->json(['message' => 'No se puede eliminar la tipificación del delito porque tiene novedades asociadas.'], 422);
        }
        $tipificacion_delito->delete();
        return response()->json(null, 204);
    }
}
