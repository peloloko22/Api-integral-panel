<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModusOperandi as RequestsModusOperandi;
use App\Models\ModusOperandi;
use Illuminate\Http\Request;

class ModusOperandiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Logic to list modus operandi
        $query = ModusOperandi::query();
        $query->orderByDesc('created_at');

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('codigo_snic')) {
            $query->where('codigo_snic', 'like', '%' . $request->codigo_snic . '%');
        }

        if ($request->has('codigo_sat')) {
            $query->where('codigo_sat', 'like', '%' . $request->codigo_sat . '%');
        }

        if ($request->boolean('all')) {
            return $query->get();
        }

        return $query->paginate($request->get('per_page', 10));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsModusOperandi $request)
    {
        $modus_operandi = ModusOperandi::create($request->validated());
        return response()->json($modus_operandi, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ModusOperandi  $modus_operandi
     * @return \Illuminate\Http\Response
     */
    public function show(ModusOperandi $modus_operandi)
    {
        return response()->json($modus_operandi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ModusOperandi  $modus_operandi
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsModusOperandi $request, ModusOperandi $modus_operandi)
    {
        $modus_operandi->update($request->validated());
        return response()->json($modus_operandi);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ModusOperandi  $modus_operandi
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModusOperandi $modus_operandi)
    {
        $modus_operandi->delete();
        return response()->json(null, 204);
    }
}
