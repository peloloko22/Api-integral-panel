<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Usuario\UsuarioStoreRequest;
use App\Http\Requests\Usuario\UsuarioUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Services\Auth\AuthenticatedUserService;

class UsuarioController extends Controller
{
    public function me(Request $request)
    {
        return $request->user()->load(User::RELACIONES);
    }

    public function index(Request $request)
    {
        $query = User::query();
        $query->orderByDesc('created_at');

        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        if ($request->has('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }


        $query->with(User::RELACIONES);

        if ($request->boolean('all')) {
            return $query->get();
        }

        return $query->paginate($request->get('per_page', 10));
    }

    public function show(User $usuario)
    {
        return $usuario;
    }

    public function store(UsuarioStoreRequest $request)
    {
        DB::transaction(function () use ($request) {

            $data = $request->validated();

            $data['password'] = Hash::make($data['password']);
            $usuario = User::create($data);

            if (isset($data['funcionario'])) {
                $usuario->funcionario()->create($data['funcionario']);
            }

            if (isset($data["roles"])) {
                $usuario->roles()->sync($data["roles"]);
            }
            return response()->json($usuario, 201);
        });

    }

    public function update(UsuarioUpdateRequest $request, User $usuario)
    {
        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $usuario->update($data);

        return response()->json($usuario, 200);
    }

    public function destroy(User $usuario)
    {
        $usuario->delete();
        return response()->json(null, 204);
    }


    public function fullUser()
    {

    }

    public function oauthMe(Request $request, AuthenticatedUserService $authUserService)
    {
        $user = $authUserService->get($request);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        return response()->json($user, 200);
    }
}
