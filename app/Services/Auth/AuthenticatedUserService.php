<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Models\UserSub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedUserService
{
    /**
     * Resolve the currently authenticated application User with eager relations.
     * Supports Sanctum (first-party) and Auth0 (stateless) authentication.
     */
    public function get(?Request $request = null): ?User
    {
        // 1) If Sanctum provided a first-party User via the Request
        if ($request && $request->user() instanceof User) {
            return $request->user()->load(User::RELACIONES);
        }

        // 2) Fallback to Laravel Auth facade (could be Sanctum or Auth0)
        $authUser = Auth::user();

        if ($authUser instanceof User) {
            return $authUser->load(User::RELACIONES);
        }

        // 3) Auth0 stateless user (or any non-Eloquent auth user): map sub -> user via UserSub
        $sub = is_object($authUser) && method_exists($authUser, 'getAuthIdentifier')
            ? $authUser->getAuthIdentifier()
            : null;
        if ($sub) {
            $userSub = UserSub::where('sub', $sub)->first();
            if ($userSub && $userSub->user) {
                return $userSub->user->load(User::RELACIONES);
            }
        }

        // 4) As a last try, check if Request carries a non-Eloquent user (e.g., Auth0 stateless)
        if ($request && $request->user() && !($request->user() instanceof User)) {
            $sub = method_exists($request->user(), 'getAuthIdentifier') ? $request->user()->getAuthIdentifier() : null;
            if ($sub) {
                $userSub = UserSub::where('sub', $sub)->first();
                if ($userSub && $userSub->user) {
                    return $userSub->user->load(User::RELACIONES);
                }
            }
        }

        return null;
    }
}
