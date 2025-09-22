<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Fiscal\FiscalStoreRequest;
use App\Http\Requests\Fiscal\FiscalUpdateRequest;
use App\Models\Fiscal;
use Illuminate\Http\Request;

class FiscalController extends Controller
{
    public function index(Request $request)
    {
        $query = Fiscal::query();
        $query->orderByDesc('created_at');

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->search . '%')
                    ->orWhere('apellido', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('dni')) {
            $query->where('dni', 'like', '%' . $request->dni . '%');
        }

        if ($request->has('telefono')) {
            $query->where('telefono', 'like', '%' . $request->telefono . '%');
        }

        if ($request->boolean('all')) {
            return $query->get();
        }

        return $query->paginate($request->get('per_page', 10));
    }

    public function show(Fiscal $fiscal)
    {
        return $fiscal;
    }

    public function store(FiscalStoreRequest $request)
    {
        $fiscal = Fiscal::create($request->validated());
        return response()->json($fiscal, 201);
    }

    public function update(FiscalUpdateRequest $request, Fiscal $fiscal)
    {

        $fiscal->update($request->validated());
        return response()->json($fiscal, 200);
    }

    public function destroy($id)
    {

        $fiscal = Fiscal::findOrFail($id);

        if ($fiscal->novedades()->exists()) {
            return response()->json(['message' => 'No se puede eliminar el fiscal porque tiene novedades asociadas.'], 422);
        }

        $fiscal->delete();
        return response()->json(null, 204);
    }
}
