<?php

namespace App\Http\Controllers;

use App\Exceptions\InternalServerException;
use App\Exceptions\LoginInvalidException;
use App\Http\Requests\Auth\SignInFormRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Hash;

class AuthController extends Controller
{
    public function login(SignInFormRequest $request)
    {
        $input = $request->validated();

        if (!auth()->attempt($input)) {
            throw new LoginInvalidException();
        }

        try {    
            session()->regenerate();
            $data = $this->authenticate($input['email'], $input['password']);
    
            return UserResource::make($data['user'])->additional($data['token']);
        } catch (Exception $e) {
            throw new InternalServerException();
        }
    }

    private function authenticate(string $email, string $password)
    {
        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            throw new LoginInvalidException();
        }

        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user'  => $user,
            'token' => ['token' => $token],
        ];
    }
}
