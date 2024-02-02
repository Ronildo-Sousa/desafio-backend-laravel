<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegisterUsercontroller extends Controller
{
    public function __invoke(Request $request)
    {
        return response()->json([], Response::HTTP_CREATED);
    }
}
