<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function login(UserLoginRequest $request)
    {
        if (!$token = auth()->attempt($request->only(['email', 'password']))) {
            return response()->json([
                'errors' => [
                    'fail' => ['Неправильные данные']
                ]
            ], 422);
        }

        return (new UserResource($request->user()))->additional([
            'meta' => [
                'token' => $token
            ]
        ]);

    }

    public function user(Request $request) {
        return new UserResource($request->user());
    }

    public function logout()
    {
        auth()->logout();
    }
}
