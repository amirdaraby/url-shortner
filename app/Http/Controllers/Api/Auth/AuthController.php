<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\LogoutRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    public function login(LoginRequest $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth = Auth::user();
            $response['token'] = $auth->createToken('LaravelSanctumAuth')->plainTextToken;
            $response['name'] = $auth->name;

            return $this->success($response, "user login", 202);
        } else return $this->error(["user" => ["user not found"]], 400);
    }


    public function register(RegisterRequest $request)
    {

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ]);

        $response['token'] = $user->createToken("token")->plainTextToken;
        $response['name'] = $user->name;

        return $this->success($response, 'User registered', 201);

    }

    public function logout(LogoutRequest $request)
    {
        $deleted = Auth::user()->tokens()->delete();
        if ($deleted)
            return $this->success([], "logged out !");
    }

}
