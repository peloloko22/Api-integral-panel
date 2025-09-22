<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Novedad;
use App\Models\ConfiguracionParte;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ParteController extends Controller
{
    public function index(Request $request)
    {
        $query = Novedad::query()
            ->with(Novedad::RELACIONES_COMPLETAS)
            ->join('tipo_novedades', 'novedades.tipo_novedad_id', '=', 'tipo_novedades.id')
            ->orderByDesc('tipo_novedades.prioridad')
            ->orderByDesc('novedades.hora_hecho')
            ->select('novedades.*'); // necesario por el join

        $config = ConfiguracionParte::first(); // config global
        $duracion = 12;

        // ✅ 1. Determinar la hora de inicio
        if ($request->has('inicio')) {
            try {
                $horaInicio = Carbon::parse($request->input('inicio'))->setTimezone('America/Argentina/Buenos_Aires');
            } catch (\Exception $e) {
                return response()->json(['error' => 'Formato de fecha inválido. Use ISO8601.'], 400);
            }
        } else {
            $horaInicio = Carbon::today()->setTimeFromTimeString($config->hora_inicio);
        }

        // ✅ 2. Calcular ventana de tiempo
        $ahora = Carbon::now('America/Argentina/Buenos_Aires');
        $desde = $horaInicio->copy();
        $hasta = $horaInicio->copy()->addHours($duracion);

        if ($ahora->between($horaInicio, $hasta)) {
            $desde->subHours($duracion);
            $hasta = $horaInicio;
        } elseif ($ahora->lt($horaInicio)) {
            $desde->subDay()->addHours(24 - $duracion);
            $hasta->subDay();
        }

        $query->whereBetween('novedades.created_at', [$desde, $hasta]);
        $query->where('novedades.incluir_parte', 1);

        // ✅ 3. Filtro departamental opcional
        if ($request->has("departamental_id")) {
            $query->whereHas('Dependencia.departamental', function ($q) use ($request) {
                $q->where('id', $request->input('departamental_id'));
            });
        }

        $novedades = $query->get();

        // ✅ 4. Respuesta
        return response()->json([
            'hora_inicio' => $horaInicio->format('H:i'),
            'parsed_inicio' => $horaInicio->toIso8601String(),
            'desde' => $desde->toIso8601String(),
            'hasta' => $hasta->toIso8601String(),
            'ahora' => $ahora->toIso8601String(),
            'novedades' => $novedades,
        ]);
    }

}
