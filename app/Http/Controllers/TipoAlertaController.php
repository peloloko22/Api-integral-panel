<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoAlerta\TipoAlertaStoreRequest;
use App\Models\TipoAlerta;

class TipoAlertaController extends Controller
{
    public function index()
    {
        $query = TipoAlerta::query();

        $query->orderByDesc('created_at');

        $query->with(['gruposPersonas']);

        $tipos = $query->get();


        return response()->json($tipos);
    }

    public function store(TipoAlertaStoreRequest $request)
    {
        $tipoAlerta = TipoAlerta::create($request->validated());
        return response()->json($tipoAlerta, 201);
    }

    public function show($id)
    {
        $tipoAlerta = TipoAlerta::findOrFail($id);
        return response()->json($tipoAlerta);
    }

    public function update(TipoAlertaStoreRequest $request, $id)
    {
        $tipoAlerta = TipoAlerta::findOrFail($id);
        $tipoAlerta->update($request->validated());
        return response()->json($tipoAlerta);
    }

    public function destroy($id)
    {
        $tipoAlerta = TipoAlerta::findOrFail($id);


        $tipoAlerta->delete();
        return response()->json(null, 204);
    }
}
