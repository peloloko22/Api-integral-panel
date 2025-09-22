<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoFormularioAyuda;
use Illuminate\Http\Request;

class TipoFormularioAyudaController extends Controller
{
    public function index()
    {
        $query = TipoFormularioAyuda::query();
        $query->orderByDesc('created_at');
        $tipos = $query->get();
        return response()->json($tipos);
    }

    public function show($id)
    {
        $tipo = TipoFormularioAyuda::findOrFail($id);
        return response()->json($tipo);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:1000',
        ]);

        $tipo = TipoFormularioAyuda::create($data);
        return response()->json($tipo, 201);
    }

    public function update(Request $request, $id)
    {
        $tipo = TipoFormularioAyuda::findOrFail($id);
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:1000',
        ]);

        $tipo->update($data);
        return response()->json($tipo);
    }

    public function destroy($id)
    {
        $tipo = TipoFormularioAyuda::findOrFail($id);

        if ($tipo->formularios()->exists()) {
            return response()->json(['message' => 'No se puede eliminar el tipo de formulario porque existen formularios que lo utilizan.'], 422);
        }

        $tipo->delete();
        return response()->json(null, 204);
    }
}
