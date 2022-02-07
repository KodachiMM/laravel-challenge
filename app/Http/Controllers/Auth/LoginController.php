<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $result = $request->authenticate($request->validated());
        return response()->json($result);
    }
}
