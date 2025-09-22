<?php

namespace App\Jobs;

use App\Models\TipoAlerta;
use App\Services\Firebase\FirebaseMicroService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EnviarAlertaAFcm implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected TipoAlerta $tipoAlerta;
    protected string $titulo;
    protected string $descripcion;

    public $tries = 3; // intenta 3 veces
    public $backoff = 10; // espera 10 segundos entre intentos

    public function __construct(TipoAlerta $tipoAlerta, string $titulo, string $descripcion)
    {
        $this->tipoAlerta = $tipoAlerta;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
    }

    public function handle(FirebaseMicroService $fcmService): void
    {

        Log::info('Entró al job del tipo de alerta', ['tipoAlerta' => $this->tipoAlerta->nombre]);
        foreach ($this->tipoAlerta->jerarquias as $jerarquia) {
            $topic = strtolower(str_replace(' ', '-', $jerarquia->nombre));
            Log::info('Enviando al topic', ['topic' => $topic]);
            $fcmService->enviarAtopico(
                $topic,
                $this->titulo,
                $this->descripcion
            );
        }
    }
}
