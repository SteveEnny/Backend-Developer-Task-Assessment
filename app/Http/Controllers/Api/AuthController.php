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
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    use ApiResponses;
    public function register(RegisterUserRequest $request){
        if($request->hasFile('avatar')){
            $path = Storage::disk('public')->put('logos', $request->file('avatar'));
            $url = asset($path);
        }
        $request_data = [
            ...$request->validated(),
            'avatar' => $url ?? 'https:\/\/ui-avatars.com\/api\/?name=Hello"' /// Add a defualt avater
        ];
        $user = User::Create($request_data);
        return $this->ok('Business created successfully', $user);
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

    public function user(){
        return $this->ok('User data', Auth::user());
    }
}