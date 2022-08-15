<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
        User::create([
            "username" => $request->username,
            "password" => Hash::make($request->password) //password encryption class Hash with static method make
        ]);

        return response()->json([
            "status" => true,
            "message" => "User created successfully"
        ]);
    }

    public function login(Request $request){
        $user = User::where('username', $request->username);

        if(is_null($user)) {
            return response()->json([
                "status" => false,
                "message" => "User not found"
            ], 401);
        };
    }
}
