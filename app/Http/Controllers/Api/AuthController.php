<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginUserRequest;
use App\Http\Requests\Api\RegisterUserRequest;
use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponses;
    public function register(RegisterUserRequest $request){
        $user = User::Create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $data = [
            'token' => $user->createToken('API token for ' . $user->email, ['*'], now()->addMinutes($value = 60))->plainTextToken,
        ];
        return $this->ok('User created successfully', $data);
    }

    public function Login(LoginUserRequest $request) {
        $request->validated($request->all());

        if(!Auth::attempt($request->only('email', 'password'))){
            return $this->error('Invalid credentials', 401);
        }
        $user = User::firstWhere('email', $request->email);
        $data = [
            'token' => $user->createToken('API token for ' . $user->email, ['*'], now()->addMinutes($value = 60))->plainTextToken,
        ];
        return $this->ok('Authenticated', $data);
    }

    public function Logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

    }
}