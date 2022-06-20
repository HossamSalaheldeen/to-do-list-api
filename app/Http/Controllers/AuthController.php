<?php

namespace App\Http\Controllers;


use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $userData = $request->safe()->only('name', 'email', 'password');

        $user = User::query()->create($userData);

        $token = $user->createToken('api_token');

        return LoginResource::make($token);

    }

    public function login(LoginRequest $request)
    {
        $reqData = $request->safe()->only([
            'email',
            'password',
        ]);

        if (!auth()->attempt($reqData)){
            throw ValidationException::withMessages( [ 'message' => 'Invalid Credentials' ] );
        }

        $user = User::query()->where('email',$reqData['email'])->first();

        $token = $user->createToken('api_token');

        return LoginResource::make($token);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response([
            'message' => 'user logout successfully',
        ], Response::HTTP_OK);
    }
}
