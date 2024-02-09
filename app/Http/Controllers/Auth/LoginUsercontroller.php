<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use Symfony\Component\HttpFoundation\Response;

class LoginUsercontroller extends Controller
{
    public function __invoke(LoginUserRequest $request)
    {
        if (!auth()->attempt($request->validated())) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }
        
        /** @var User $user */
        $user = $request->user();

        return response()->json(['token' => $user->getNewToken()]);
    }
}
