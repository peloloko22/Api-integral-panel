<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaDelito\CategoriaDelitoStoreRequest;
use App\Models\CategoriaDelito;
use Illuminate\Http\Request;

class CategoriaDelitoController extends Controller
{
    public function index(Request $request)
    {
        $query = CategoriaDelito::query();
        $query->orderByDesc('created_at');

        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        if ($request->boolean('all')) {
            return $query->get();
        }

        return $query->paginate($request->get('per_page', 10));
    }

    public function show(CategoriaDelito $categoria_delito)
    {
        return $categoria_delito->load('tipificaciones');
    }


    public function store(CategoriaDelitoStoreRequest $request)
    {
        $categoria_delito = CategoriaDelito::create($request->validated());
        return response()->json($categoria_delito, 201);
    }

    public function update(CategoriaDelitoStoreRequest $request, CategoriaDelito $categoria_delito)
    {
        $categoria_delito->update($request->validated());
        return response()->json($categoria_delito, 200);
    }

    public function destroy($id)
    {

        $categoria_delito = CategoriaDelito::findOrFail($id);
        if ($categoria_delito->tipificaciones()->exists()) {
            return response()->json(['error' => 'No se puede eliminar la categoría porque tiene tipificaciones asociadas.'], 422);
        }


        $categoria_delito->delete();
        return response()->json(null, 204);
    }
}
