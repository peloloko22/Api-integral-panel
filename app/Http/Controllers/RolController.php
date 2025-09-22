<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permisos;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolController extends Controller
{
    public function index(Request $request)
    {
        $query = Rol::query();
        $query->orderByDesc('created_at');

        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        if ($request->boolean('all')) {
            return $query->get();
        }

        return $query->paginate($request->get('per_page', 10));
    }

    public function show(Rol $rol)
    {
        return $rol;
    }

    public function store(Request $request)
    {
        $rol = Rol::create($request->all());
        return response()->json($rol, 201);
    }

    public function update(Request $request, Rol $rol)
    {
        $rol->update($request->all());
        return response()->json($rol, 200);
    }

    public function destroy(Rol $rol)
    {
        DB::transaction(function () use ($rol) {
            Permisos::where('rol_id', $rol->id)->delete();
            $rol->delete();
        });

        return response()->json(null, 204);
    }
}
