<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:admins,email|unique:users,email',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $tokenResult = $user->createToken('Personal Access Token', ['user']);

        $token = $tokenResult->token;

        $token->save();

        return response([
            'user' => $user,
            'token' => $tokenResult->accessToken,
        ]);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($data)) {
            return response([
                'error' => 'The provided credentials are not correct'
            ], 422);
        }

        $user = Auth::user();

        $tokenResult = $user->createToken('Personal Access Token' ,['user']);

        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        } else if (!$request->remember_me) {
            $token->expires_at = Carbon::now()->addDay(1);
        }

        $token->save();

        return response([
            'user' => $user,
            'token' => $tokenResult->accessToken,
        ]);
    }

    public function logout()
    {
        $user = Auth::user();

        $user->token()->revoke();
        return response([
            'success' => true
        ]);
    }
}
