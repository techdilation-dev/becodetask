<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    /**
     * to get user login token
     */
    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|email|max:100',
            'password' => 'required|max:16'
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return response()->json([
                'message' => 'Logged in successfully',
                'token' => Auth::user()->createToken('Access Token')->accessToken,
            ], 200);
        }else{
            return response()->json([
                'message' => 'Wrong Credentials'
            ], 401);
        }
    }
}
