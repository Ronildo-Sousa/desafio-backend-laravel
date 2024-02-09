<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class RegisterUsercontroller extends Controller
{
    public function __invoke(RegisterUserRequest $request)
    {
        $user = User::query()->create($request->validated());
        $user->wallet()->create();

        return response()->json([
            'message' => 'user created',
            'user' => $user,
        ], Response::HTTP_CREATED);
    }
}
