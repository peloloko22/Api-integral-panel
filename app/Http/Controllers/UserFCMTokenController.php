<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserFCMToken;
use App\Services\Auth\AuthenticatedUserService;
use App\Services\Firebase\FirebaseMicroService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class UserFCMTokenController extends Controller
{
    protected FirebaseMicroService $firebaseService;

    public function __construct(FirebaseMicroService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    /**
     * Registrar o actualizar un token FCM para el usuario autenticado,
     * solo si se pudo suscribir exitosamente al tópico.
     */
    public function store(Request $request, AuthenticatedUserService $authUserService)
    {
        $request->validate([
            'fcm_token' => 'required|string',
            'platform' => 'nullable|string',
            'topic' => 'required|string',
            'device_id' => 'required|string',
        ]);

        $user = $authUserService->get($request);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $tokenFCM = $request->fcm_token;
        $platform = $request->platform ?? 'web';
        $topic = $request->topic;
        $deviceId = $request->device_id;

        // Intentar suscribirse al tópico
        $resultado = $this->firebaseService->suscribirATopicManualmente($tokenFCM, $topic);

        $data = $resultado->getData(true); // devuelve array asociativo

        if (isset($data['error'])) {
            Log::warning("Error al suscribir FCM token al tópico", [
                'user_id' => $user->id,
                'token' => $tokenFCM,
                'topic' => $topic,
                'error' => $data['error'],
                'device_id' => $deviceId,
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'No se pudo suscribir al tópico',
                'detalle' => $data['error'],
            ], 400);
        }

        // Solo si fue exitosa la suscripción
        $token = UserFCMToken::updateOrCreate(
            ['fcm_token' => $tokenFCM],
            [
                'device_id' => $deviceId,
                'user_id' => $user->id,
                'platform' => $platform,
                'topic' => $topic,
                'last_used_at' => now(),
            ]
        );

        return response()->json(['status' => 'ok', 'token' => $token]);
    }

    /**
     * Eliminar el token FCM del usuario actual.
     */
    public function destroy(Request $request, AuthenticatedUserService $authUserService)
    {
        $request->validate([
            'fcm_token' => 'required|string',
        ]);

        $user = $authUserService->get($request);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        UserFCMToken::where('user_id', $user->id)
            ->where('fcm_token', $request->fcm_token)
            ->delete();

        return response()->json(['status' => 'eliminado']);
    }
}
