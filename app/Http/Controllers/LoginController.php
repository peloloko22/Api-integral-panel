<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(LoginRequest $request)
    {

        if (Auth::guard('web')->attempt($request->validated())) {
            $user = Auth::guard('web')->user();
            //$token = $user->createToken('auth_token')->plainTextToken;

            $user->load(User::RELACIONES);
            return response()->json($user, 200);
        }

        return response()->json(['message' => 'Las credenciales no son válidas'], 401);
    }
}
