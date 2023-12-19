<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;

class HomeController extends Controller
{
    public function __invoke()
    {
        request()->validate([
            "user_name" => "required|string|min:3|alpha_num|exists:users,user_name",
        ]);
        $user = User::where("user_name", \request("user_name"))->first();

        return redirect(tenant_route("{$user->user_name}." . request()->getHost(), "login",["phone_number"=>$user->user_name]));
    }

    public function showHomeForm()
    {

        return view("main");
    }
}
