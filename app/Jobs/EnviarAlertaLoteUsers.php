<?php

namespace App\Jobs;

use App\Models\Alerta;
use App\Models\GrupoPersonas;
use App\Models\TipoAlerta;
use App\Models\TipoAlertaGrupoPersonas;
use App\Models\UserFCMToken;
use App\Services\Firebase\FirebaseMicroService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EnviarAlertaLoteUsers implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected TipoAlerta $tipoAlerta;
    protected string $titulo;
    protected string $descripcion;
    protected string $alertaID;

    public $tries = 3; // intenta 3 veces
    public $backoff = 10; // espera 10 segundos entre intentos

    public function __construct(TipoAlerta $tipoAlerta, string $titulo, string $descripcion, string $alertaID)
    {
        $this->tipoAlerta = $tipoAlerta;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->alertaID = $alertaID;
    }

    public function handle(FirebaseMicroService $fcmService): void
    {
        $alerta = Alerta::find($this->alertaID);

        if (!$alerta) {
            Log::error('Alerta no encontrada', ['alertaId' => $this->alertaID]);
            return;
        }

        $gruposPersonas = $this->tipoAlerta->gruposPersonas()->with('personas.fcmTokens')->get();

        Log::info('debug', ['grupoPersonas' => $gruposPersonas]);


        $tokens = $gruposPersonas->flatMap(function (GrupoPersonas $grupo) {
            return $grupo->personas->flatMap(function ($persona) {
                return $persona->fcmTokens
                    ->where('valido', true)
                    ->sortByDesc('updated_at') // o 'last_used_at'
                    ->unique('device_id')      // solo uno por dispositivo
                    ->pluck('fcm_token');
            });
        })->unique()->values()->all();

        Log::info('debug', ['tokens' => $tokens]);

        if (empty($tokens)) {
            Log::warning('No se encontraron tokens válidos para enviar la alerta.', [
                'tipoAlerta' => $this->tipoAlerta->nombre,
            ]);
            return;
        }
        Log::info('Entró al job del tipo de alerta', ['tipoAlerta' => $this->tipoAlerta->nombre]);
        $respuesta = $fcmService->enviarAlote($tokens, $this->titulo, $this->descripcion, $this->alertaID);

        // Marcar tokens inválidos si los hay
        if ($respuesta->getStatusCode() >= 200 && $respuesta->getStatusCode() < 300) {
            $alerta->update([
                          'enviada' => true,
                          'fecha_hora_envio' => now()
                      ]);
            $data = $respuesta->getData(true); // Get decoded JSON response as array

            $tokensInvalidos = collect($data['tokensInvalidos'] ?? [])
                ->pluck('token')
                ->filter();

            if ($tokensInvalidos->isNotEmpty()) {
                UserFCMToken::whereIn('fcm_token', $tokensInvalidos)->update([
                    'valido' => false,
                ]);

                Log::info('Tokens FCM inválidos desactivados', [
                    'cantidad' => $tokensInvalidos->count(),
                    'tipoAlerta' => $this->tipoAlerta->nombre,
                ]);
            }
        } else {
            Log::error('Error al enviar alerta FCM (microservicio)', [
                'status' => $respuesta->status(),
                'body' => $respuesta,
            ]);
        }
    }
}
