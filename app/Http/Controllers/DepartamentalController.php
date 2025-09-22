<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Departamental\DepartamentalStoreRequest;
use App\Http\Requests\Departamental\DepartamentalUpdateRequest;
use App\Models\Departamental;
use Illuminate\Http\Request;

class DepartamentalController extends Controller
{
    public function index(Request $request)
    {
        $query = Departamental::query();
        $query->orderByDesc('created_at');

        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->input('search') . '%');
        }

        if ($request->has('codigo')) {
            $query->where('codigo', 'like', '%' . $request->input('codigo') . '%');
        }

        if ($request->boolean('all')) {
            return $query->get();
        }

        return $query->paginate($request->get('per_page', 10));
    }

    public function show(Departamental $departamental)
    {
        return $departamental;
    }

    public function store(DepartamentalStoreRequest $request)
    {
        $departamental = Departamental::create($request->validated());
        return response()->json($departamental, 201);
    }

    public function update(DepartamentalUpdateRequest $request, Departamental $departamental)
    {

        $departamental->update($request->validated());
        return response()->json($departamental, 200);
    }

    public function destroy(Departamental $departamental)
    {
        if ($departamental->dependencias()->count() > 0) {
            return response()->json(['message' => 'No es posible eliminar la departamental porque tiene dependencias asociadas.'], 403);
        }
        $departamental->delete();
        return response()->json(null, 204);
    }
}
