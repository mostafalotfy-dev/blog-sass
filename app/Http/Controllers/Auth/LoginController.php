<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function showLoginForm()
    {
        return view("main");
    }


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function username()
    {
        return "phone_number";
    }

    public function redirectTo(): array|string
    {
        return route("home");
    }

    protected function authenticated(Request $request, $user)
    {
        $token = $user->createToken("sassProject")->plainTextToken;
        return \response()->json([

            "redirectTo"=>str($request->getHost())->contains($user->user_name) ? route("home",["token"=>$token])  : tenant_route($user->user_name.".".$request->getHost(),"home",["token"=> $token ])
        ]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
