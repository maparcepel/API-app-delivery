<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    
    public function register(Request $request) {

        $validatedData = $request->validate([
            'name'      => 'required|max:255',
            'surname'   => 'required|max:255',
            'phone'     => 'required|max:20',
            'email'     => 'required|email|unique:users',
            'user_type' => 'required|max:20',
            'password'  => 'required|confirmed'
        ]);
        
        $validatedData['password'] = Hash::make($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([
            'user' => $user,
            'access_token' => $accessToken
        ]);
    }

    public function login(Request $request){

        $loginData = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        if(!auth()->attempt($loginData)){
            return response(['message' => 'Invalid credentials'], 401);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }
}
