<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(Request $request){
        
        

        $validateData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);
        $validateData['password'] = bcrypt($request->password);

        $user = User::create($validateData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user'=>$user, 'access_token' => $accessToken]);
    }

    public function login(Request $request){
        
        $validateData = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);


        if(!auth()->attempt($validateData)){
            return response(['message' => 'Invalid email or password']);
        }


        $user = Auth::user();

        $token = $user->createToken('authToken')->accessToken;

        $user->access_token = $token;

        return response(['user' => $user]);
    }
}
