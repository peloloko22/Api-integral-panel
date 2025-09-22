<?php

namespace App\Services\Firebase;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FirebaseMicroService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.fcm_microservice.url');
    }

    public function suscribirATopicManualmente($tokenFCM, $topic)
    {
        try {
            $response = Http::post("{$this->baseUrl}/subscribe", [
                'token' => $tokenFCM,
                'topic' => $topic
            ]);

            if ($response->failed()) {
                Log::error('Error al suscribir al topic', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return response()->json([
                    'error' => 'Error desde microservicio',
                    'status' => $response->status(),
                    'body' => $response->body(), // <-- esto te da el error real
                ], $response->status());
            }

            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            Log::error('Excepción al conectar con microservicio', [
                'exception' => $e,
            ]);

            return response()->json([
                'error' => 'Excepción al conectar',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function enviarAlote(array $tokens, string $titulo, string $descripcion, string $alertaID)
    {
        try {
            $response = Http::post("{$this->baseUrl}/enviar-lote", [
                'tokens' => $tokens,
                'title' => $titulo,
                'body' => $descripcion,
                'alertaID' => $alertaID
            ]);

            if ($response->failed()) {
                Log::error('Error al enviar notificación por lote', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return response()->json([
                    'error' => 'Error desde microservicio',
                    'status' => $response->status(),
                    'body' => $response->body(),
                ], $response->status());
            }

            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            Log::error('Excepción al conectar con microservicio (lote)', [
                'exception' => $e,
            ]);

            return response()->json([
                'error' => 'Excepción al conectar',
                'message' => $e->getMessage(),
            ], 500);
        }
    }



    public function enviarAtopico($topic, $titulo, $descripcion)
    {
        try {
            $response = Http::post("{$this->baseUrl}/enviar", [
                'topic' => $topic,
                'title' => $titulo,
                'body' => $descripcion
            ]);

            if ($response->failed()) {
                Log::error('Error al enviar al topic', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return response()->json([
                    'error' => 'Error desde microservicio',
                    'status' => $response->status(),
                    'body' => $response->body(), // <-- esto te da el error real
                ], $response->status());
            }

            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            Log::error('Excepción al conectar con microservicio', [
                'exception' => $e,
            ]);

            return response()->json([
                'error' => 'Excepción al conectar',
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function desuscribirATopicManualmente($tokenFCM, $topic)
    {
        try {
            $response = Http::post("{$this->baseUrl}/unsubscribe", [
                'token' => $tokenFCM,
                'topic' => $topic
            ]);

            if ($response->failed()) {
                Log::error('Error al desuscribir del topic', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return response()->json([
                    'error' => 'Error desde microservicio',
                    'status' => $response->status(),
                    'body' => $response->body(), // <-- esto te da el error real
                ], $response->status());
            }

            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            Log::error('Excepción al conectar con microservicio', [
                'exception' => $e,
            ]);

            return response()->json([
                'error' => 'Excepción al conectar',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
