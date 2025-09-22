<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Departamento\DepartamentoStoreRequest;
use App\Http\Requests\Departamento\DepartamentoUpdateRequest;
use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function index(Request $request)
    {
        $query = Departamento::query();
        $query->orderByDesc('created_at');

        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->input('search') . '%');
        }

        if ($request->has('provincia_id')) {
            $query->where('provincia_id', $request->input('provincia_id'));
        }

        if ($request->has('codigo')) {
            $query->where('codigo', 'like', '%' . $request->input('codigo') . '%');
        }

        $query->with(['provincia']);

        if ($request->boolean('all')) {
            return $query->get();
        }

        return $query->paginate($request->get('per_page', 10));
    }

    public function show(Departamento $departamento)
    {
        return $departamento->load(['provincia']);
    }

    public function store(DepartamentoStoreRequest $request)
    {
        $departamento = Departamento::create($request->validated());
        return response()->json($departamento, 201);
    }

    public function update(DepartamentoUpdateRequest $request, Departamento $departamento)
    {
        $departamento->update($request->validated());
        return response()->json($departamento, 200);
    }

    public function destroy($id)
    {

        $departamento = Departamento::findOrFail($id);

        if ($departamento->localidades()->exists()) {
            return response()->json(['message' => 'No se puede eliminar el departamento porque tiene localidades asociadas.'], 422);
        }

        if ($departamento->municipios()->exists()) {
            return response()->json(['message' => 'No se puede eliminar el departamento porque tiene municipios asociadas.'], 422);
        }


        $departamento->delete();
        return response()->json(null, 204);
    }
}
