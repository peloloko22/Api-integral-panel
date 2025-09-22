<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Jerarquia\JerarquiaStoreRequest;
use App\Http\Requests\Jerarquia\JerarquiaUpdateRequest;
use App\Models\Jerarquia;
use Illuminate\Http\Request;

class JerarquiaController extends Controller
{
    public function index(Request $request)
    {
        $query = Jerarquia::query();
        $query->orderByDesc('created_at');

        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        if ($request->boolean('all')) {
            return $query->get();
        }

        return $query->paginate($request->get('per_page', 10));
    }

    public function show(Jerarquia $jerarquia)
    {
        return $jerarquia;
    }

    public function store(JerarquiaStoreRequest $request)
    {
        $jerarquia = Jerarquia::create($request->validated());
        return response()->json($jerarquia, 201);
    }

    public function update(JerarquiaUpdateRequest $request, Jerarquia $jerarquia)
    {
        $jerarquia->update($request->validated());
        return response()->json($jerarquia, 200);
    }

    public function destroy(Jerarquia $jerarquia)
    {
        $jerarquia->delete();
        return response()->json(null, 204);
    }
}
