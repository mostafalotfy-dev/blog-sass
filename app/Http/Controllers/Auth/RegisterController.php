<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Tenant;
use Stancl\Tenancy\Database\Models\Domain;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function redirectTo(): array|string
    {
        return tenant_route(\request()->user()->user_name . "." . request()->getHost(), "home");
    }

    protected function registered(Request $request, $user)
    {
        $response = new Response([
            "redirectTo" => tenant_route($user->user_name . "." . request()->getHost(), "home",["token"=>$user->createToken("sassProject")->plainTextToken]),
                ]
            );
        return $response;

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users',],
            "user_name" => "required|unique:users,user_name|alpha_num",
            "phone_number" => "required|string|unique:users,phone_number|regex:/^[0-9]+/",
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {


        Tenant::create([
            "tenancy_db_name" => $data["user_name"]
        ])->createDomain([
            "domain" => $data["user_name"]
        ]);

        $user = new User([
            'name' => $data['name'],
            'email' => $data['email'],
            "phone_number" => $data["phone_number"],
            "user_name" => $data["user_name"],
            'password' => Hash::make($data['password']),
        ]);
        $user->save();

        return $user;

    }

}
