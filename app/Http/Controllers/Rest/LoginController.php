<?php

namespace App\Http\Controllers\Rest;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        \request()->validate([
            "user_name"=>"required|exists:users,user_name",
            "password"=>"required"
        ]);
        $user = User::where("user_name",\request("user_name"))->firstOrFail();
        $user->tokens()->delete();
        $password= Hash::check(\request("password"),$user->password);
        if(!$password)
        {
            return response([],401);
        }
        $token = $user->createToken("Sass-project");
        return response()->json([
            $token->plainTextToken
        ]);

    }
}
