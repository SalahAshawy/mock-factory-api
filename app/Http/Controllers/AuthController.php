<?php
namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Actions\AttemptLoginAction;
use App\Actions\RegisterUserAction;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $user = AttemptLoginAction::execute(
            $request->input('email'),
            $request->input('password')
        );

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user'  => $user,
        ]);
    }
    public function register(RegisterRequest $request)
{
    $user = RegisterUserAction::execute($request->validated());

    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user'  => $user,
    ]);
}
}
