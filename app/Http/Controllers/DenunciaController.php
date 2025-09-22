<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Denuncia as RequestsDenuncia;
use App\Http\Requests\DenunciaIndexRequest;
use App\Models\Denuncia;
use Illuminate\Http\Request;

class DenunciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DenunciaIndexRequest $request)
    {
        // Logic to list all denuncias

       
        $query = Denuncia::query();
        $query->orderByDesc('created_at');

        if ($request->has('tipo_denuncia_id')) {
            $query->where('tipo_denuncia_id', $request->tipo_denuncia_id);
        }

        if ($request->has('tipificacion_delito_id')) {
            $query->where('tipificacion_delito_id', $request->tipificacion_delito_id);
        }

        if ($request->has('dependencia_id')) {
            $query->where('dependencia_id', $request->dependencia_id);
        }

        if ($request->has('fiscal_id')) {
            $query->where('fiscal_id', $request->fiscal_id);
        }

        if ($request->has('funcionario_interviniente')) {
            $query->where('funcionario_interviniente', $request->funcionario_interviniente);
        }

        if ($request->has('victima_id')) {
            $query->where('victima_id', $request->victima_id);
        }

        if ($request->has('denunciante_id')) {
            $query->where('denunciante_id', $request->denunciante_id);
        }

        if ($request->has('fecha_hecho')) {
            $query->where('fecha_hecho', $request->fecha_hecho);
        }

        if ($request->has('fecha_denuncia')) {
            $query->where('fecha_denuncia', $request->fecha_denuncia);
        }

        // Filtros por rango de fecha del hecho
        if ($request->has('fecha_hecho_desde')) {
            $query->whereDate('fecha_hecho', '>=', $request->fecha_hecho_desde);
        }

        if ($request->has('fecha_hecho_hasta')) {
            $query->whereDate('fecha_hecho', '<=', $request->fecha_hecho_hasta);
        }

        // Filtros por rango de fecha de la denuncia
        if ($request->has('fecha_denuncia_desde')) {
            $query->whereDate('fecha_denuncia', '>=', $request->fecha_denuncia_desde);
        }

        if ($request->has('fecha_denuncia_hasta')) {
            $query->whereDate('fecha_denuncia', '<=', $request->fecha_denuncia_hasta);
        }

        if ($request->has('registrada_en_estadisticas')) {
            $query->where('registrada_en_estadisticas', $request->registrada_en_estadisticas);
        }

        $query->with(['tipoDenuncia', 'tipificacionDelito', 'dependencia', 'fiscal', 'victima', 'denunciante']);

        if ($request->boolean('all')) {
            return $query->get();
        }

        return $query->paginate($request->get('per_page', 10));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestsDenuncia $request)
    {
        $denuncia = Denuncia::create($request->validated());

        return response()->json($denuncia, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Denuncia $denuncia)
    {
        $query = Denuncia::with(['tipoDenuncia', 'tipificacionDelito', 'dependencia', 'fiscal', 'victima', 'denunciante']);
        $denuncia = $query->findOrFail($denuncia->id);
        return $denuncia;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RequestsDenuncia $request, Denuncia $denuncia)
    {
        $denuncia->update($request->validated());
        return response()->json($denuncia);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Denuncia $denuncia)
    {
        $denuncia->delete();
        return response()->json(null, 204);
    }
}
