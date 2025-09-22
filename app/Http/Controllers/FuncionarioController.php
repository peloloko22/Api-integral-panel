<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Funcionario\FuncionarioStoreRequest;
use App\Http\Requests\Funcionario\FuncionarioUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    public function index(Request $request)
    {
        $query = Funcionario::query();
        $query->orderByDesc('created_at');

        if ($request->has('jerarquia_id')) {
            $query->where('jerarquia_id', $request->jerarquia_id);
        }

        if ($request->has('search')) {
            $query->where('lp', 'like', '%' . $request->search . '%');
        }

        $query->with('jerarquia');

        // ✅ Si viene ?all=true, devolvemos todo sin paginar
        if ($request->boolean('all')) {
            return $query->get();
        }

        // ✅ Si no, devolvemos paginado (por defecto 10)
        return $query->paginate($request->get('per_page', 10));
    }

    public function show(Funcionario $funcionario)
    {
        return $funcionario->load('jerarquia');
    }

    public function store(FuncionarioStoreRequest $request)
    {
        $funcionario = Funcionario::create($request->validated());
        return response()->json($funcionario, 201);
    }

    public function update(FuncionarioUpdateRequest $request, Funcionario $funcionario)
    {
        $funcionario->update($request->validated());
        return response()->json($funcionario, 200);
    }

    public function destroy(Funcionario $funcionario)
    {
        $funcionario->delete();
        return response()->json(null, 204);
    }
}
