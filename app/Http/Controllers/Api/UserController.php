<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    // Login
    public function login(Request $request){
        
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            
            return response()->json([
                'status'  => false,
                'message' => 'Invalid credentials',
                'data'    => []
            ], 401);        
        }

        
        $user  = Auth::user();
        $token = $user->createToken('API Token')->accessToken;

        $data = array(
            'token' => $token,
            'user'  => $user
        );
        
        return response()->json([
            'status'  => true,
            'message' => 'Loggin successfully.',
            'data'    => $data
        ], 200);
    }

    
    // Logout
    public function logout(Request $request){
        
        $request->user()->token()->revoke();
        
        return response()->json([
            'status'  => true,
            'message' => 'Logged out.',
            'data'    => []
        ], 200);
    }
}
