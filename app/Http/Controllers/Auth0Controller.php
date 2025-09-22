<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthSyncRequest;
use App\Models\User;
use App\Models\UserSub;
use Illuminate\Http\Request;

class Auth0Controller extends Controller
{
    public function mesub(Request $request)
    {
        $rules = [
            'email' => 'required|string',
        ];
        $validated = $request->validate($rules);

        $user = User::where('email', $validated['email'])->with(User::RELACIONES)->first();

        return response()->json($user, 200);
    }

    public function sync(AuthSyncRequest $request)
    {

        // el usuario puede tener varios subs. el email es el identificador único de la cuenta
        $data  = $request->validated();
        $user = User::where('email', $data['email'])->first();
        if (!$user) {
            $user = User::create([
                'nombre' => $data['nombre'] ?? '',
                'apellido' => $data['apellido'] ?? '',
                'email' => $data['email'],
            ]);
        }
        // si la sub existe no la crea, si no existe la crea y la asocia al usuario
        UserSub::firstOrCreate(
            ['sub' => $data['sub']],
            ['user_id' => $user->id]
        );

        return response()->json($user->load(User::RELACIONES), 201);
    }
}
