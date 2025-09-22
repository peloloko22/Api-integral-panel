<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormularioAyuda\FormularioAyudaStoreRequest;
use Illuminate\Http\Request;
use App\Models\FormularioAyuda;

class FormularioAyudaController extends Controller
{
    public function index()
    {
        $query = FormularioAyuda::query();
        $query->orderByDesc('created_at');
        $formularios = $query->get();
        return response()->json($formularios);
    }

    public function show($id)
    {
        $formularios = FormularioAyuda::findOrFail($id);
        return response()->json($formularios);
    }

    public function store(FormularioAyudaStoreRequest $request)
    {
        $formularios = FormularioAyuda::create($request->validated());
        return response()->json($formularios, 201);
    }

    public function update(FormularioAyudaStoreRequest $request, $id)
    {
        $formularios = FormularioAyuda::findOrFail($id);
        $formularios->update($request->validated());
        return response()->json($formularios);
    }

    public function destroy($id)
    {
        $formularios = FormularioAyuda::findOrFail($id);
        $formularios->delete();
        return response()->json(null, 204);
    }

}
