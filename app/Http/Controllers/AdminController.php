<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:admins,email|unique:users,email',
            'password' => 'required',
        ]);

        $admin = Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $tokenResult = $admin->createToken('Personal Access Token');

        $token = $tokenResult->token;

        $token->save();

        return response([
            'user' => $admin,
            'token' => $tokenResult->accessToken,
            'admin' => true,
        ]);
    }

    public function login(Request $request)
    {

        $data = $request->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => 'required',
        ]);

        
        // if (!Auth::guard('api-admins')->validate($data)) {
        //     return response([
        //         'error' => 'The provided credentials are not correct'
        //     ], 422);
        // }
        $preAdmin = Admin::where('email', $data['email'])->first();

        $hashing = Hash::check($data['password'], $preAdmin->password);


        if (!Hash::check($data['password'], $preAdmin->password)) {

            return response([
                'error' => 'The provided credentials are not correct'
            ], 422);
        }
        
        $user = Admin::where('email', $data['email'])->first();

        Auth::guard('api-admins')->setUser($user);

        $admin = Auth::guard('api-admins')->user();

        
        //  if (!Auth::guard('admin')->validate([
        //     'email' => 'required|email|exists:admins,email',
        //     'password' => 'required',
        // ])) {
        //     return response([
        //         'error' => 'The provided credentials are not correct'
        //     ], 422);
        // }
        // $admin = Auth::guard('admin')->setUser(Authenticatable $user);


        $tokenResult = $admin->createToken('Admin Access Token', ['admin']);

        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        } else if (!$request->remember_me) {
            $token->expires_at = Carbon::now()->addDay(1);
        }

        $token->save();
        $isAdmin = true;
        return response([
            'user' => $admin,
            'token' => $tokenResult->accessToken,
            'admin' => $isAdmin,
        ]);
    }

    public function logout()
    {
        $admin = Auth::user();

        $admin->token()->revoke();

        return response([
            'success' => 'Logged out successfully'
        ]);
    }
}